<?php
require('database_stuffs.php');

// Retrieve the form data
$player = $_POST['selected_player'];
$golferScore = $_POST['golferScore'];
$nineHandicap = $_POST['nineHandicap'];
$handicap = $_POST['handicap'];
$par = $_POST['par'];

// Update the player's info in the database
$sql = "UPDATE ".$table." SET golferScore=$golferScore, nineHandicap=$nineHandicap, handicap=$handicap, par=$par WHERE players='$player'";
if ($conn->query($sql) === TRUE) {
    $response = array("status" => "success", "message" => "Record updated successfully");
} else {
    $response = array("status" => "error", "message" => "Error updating record: " . $conn->error);
}

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>