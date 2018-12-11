<?php
require('parsePlace.php');
$api = 'https://graph.facebook.com/search?';
//q=restaurant&type=place&center=59.4713933,24.4580691&distance=16000'
$fieldsparam = '&fields=';
$fields = 'name,category_list,hours,checkins,picture,location,link,parking,price_range,rating_count,overall_star_rating,restaurant_specialties,website,is_permanently_closed';
$tokenparam = 'access_token=';
$token = '449290905599246|5jxL2JwEgZXt1j4DfSD1LIX2Ozk'; // insert api token here
$query= '&q=restaurant&type=place&center=59.4713933,24.4580691&distance=16000';
$url = $api. $tokenparam. $token. $fieldsparam. $fields. $query;
$page = '';
$restaraunts = array();
function fbQuery($link, $restarauntArray){
  /*$datastring = file_get_contents($link);
  $json = json_decode($datastring);
  foreach ($json->data as $item) {
        array_push($restarauntArray, $item);
    }
    if(isset($json->paging->next)){
      $link = $json->paging->next;
      fbQuery($link, $restarauntArray);
    } else {
      //echo ('count is:' .count($restarauntArray));
      var_dump($restarauntArray);
      echo('<br>');
      echo '<br>';
    }/*/
    $i = 0;
    $datastring = file_get_contents($link);
    $json = json_decode($datastring);
    $end = 0;
    while($end === 0){
      foreach($json as $chunk){
        foreach($chunk as $item){
          if(isset($item->name)){
            array_push($restarauntArray, $item);
          } else {
            //check that its not the last chunk
            if(isset($chunk->next)){
              /*if there is another chunk, get the datastring from
               the other chunk and return to the while loop     */
              $datastring = file_get_contents($chunk->next);
              $json = json_decode($datastring);
              break 2;
            } else {
              //no more chunks, ends all three loops
              $end = 1;
            }

          }
        }
      }
    }
    return $restarauntArray;
}

$restaraunts = fbQuery($url, $restaraunts);
savePlaces($restaraunts);

?>
