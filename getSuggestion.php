<?php
require('../../config.php');
function getSuggestion(){
  $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"],$GLOBALS["serverPassword"], $GLOBALS["database"]);
  $stmt = $mysqli->prepare("SELECT DISTINCT(Restaraunts.name), Restaraunts.checkins, Restaraunts.image, Restaraunts.location, Restaraunts.link,
    Restaraunts.pricerange, Restaraunts.ratingcount, Restaraunts.rating,Categories.Category FROM Restaraunts
    Inner Join Categories on Restaraunts.id = Categories.restaraunt_id
    ORDER BY RAND() LIMIT 3");
  //echo $mysqli->error;
?>
