<?php
require('database_stuffs.php');
if (isset($_POST['players'])) {
    $players = strip_tags($_POST['players']);
    $golferScore = strip_tags($_POST['Golferscore']);
    $handicap = strip_tags($_POST['handicap']);
    $NineholeHandicap = strip_tags($_POST['NineholeHandicap']);
    $par = strip_tags($_POST['par']);
    $sql = "UPDATE ".$table." SET golferScore = '$golferScore', handicap = '$handicap', NineholeHandicap = '$NineholeHandicap', par = '$par' WHERE players = '$players'";
    }?>

?>