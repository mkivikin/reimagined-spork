<?php
require('../../config.php');
$database = "if17_restaraunts";

function savePlaces($places){
    $msg = "";
    $counter = 0;
    $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"],$GLOBALS["serverPassword"], $GLOBALS["database"]);
    if(count($places)>1){ //Kui restoranide array pole tühi
      $stmt = $mysqli->prepare('truncate TABLE Restaraunts');
      if($stmt->execute()){
      } else {
      }
    }
    foreach ($places as $place) {
      if($place->is_permanently_closed != 1 || (isset($place->name)) || (isset($place->address_street))){  /*Only save if place the not permanently closed */
        if(isset($place->location)){
          if(isset($place->location->street) && isset($place->location->city)){
            $location = $place->location->street .', ' .$place->location->city;
          } else {
            $location = '';
          }
        }
        if(!(isset($place->phone))){
          $place->phone = '';
        }
        $stmt = $mysqli->prepare("INSERT INTO Restaraunts (fb_id, name, engagement, checkins, image, location, phone, link, pricerange, ratingcount, rating) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
        //echo $mysqli->error;
        $stmt->bind_param("isiisssssid", $place->id, $place->name,$place->engagement->count,$place->checkins, $place->picture->data->url, $location, $place->phone,$place->link,$place->price_range, $place->rating_count, $place->overall_star_rating);
        var_dump($place->category_list);
        if ($stmt->execute()) {
          $counter++;
          echo($counter);
          $stmt1 = $mysqli->prepare("INSERT INTO Categories (restaraunt_id, category) values (?,?)");
          var_dump($place->category_list);
          foreach($place->category_list as $category) {
            $stmt1->bind_param("is", $counter, $category->name);
            $stmt1->execute();
          }
          }
        } else {
          echo "Error: " .$stmt->error;
        }
      }
    $stmt->close();
    $mysqli->close();
        /*var_dump($place->category_list);
        echo('<br>');
        var_dump($place->hours);*/
    }
 ?>
