<?php
require('../../config.php');
$database = 'if17_restaraunts';
if($_POST["action"]="default"){
    echo json_encode(getSuggestion());
}
function getSuggestion(){
  $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"],$GLOBALS["serverPassword"], $GLOBALS["database"]);
  $stmt = $mysqli->query("SELECT DISTINCT(Restaraunts.name), Restaraunts.checkins, Restaraunts.image, Restaraunts.location, Restaraunts.link,
    Restaraunts.pricerange, Restaraunts.ratingcount, Restaraunts.rating,Categories.Category FROM Restaraunts
    Inner Join Categories on Restaraunts.id = Categories.restaraunt_id
    ORDER BY RAND() LIMIT 3");
    //$stmt->bind_result($name, $checkins, $image, $location, $link, $pricerange, $ratingcount, $rating, $category);
    $places = array();
    while($row = $stmt->fetch_assoc()){
      array_push($places, $row);
    }
    return $places;
}
?>
