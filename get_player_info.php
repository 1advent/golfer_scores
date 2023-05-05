<?php
// Include database connection code
require('database_stuffs.php');

// Get the selected player's name from the POST request
$selected_player = $_POST['selected_player'];

// Prepare and execute the SQL query to get player information
$query = "SELECT * FROM ".$table." WHERE players = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $selected_player);
$stmt->execute();
$result = $stmt->get_result();

// Retrieve the player's information from the query result
if ($result->num_rows > 0) {
    $player_info = $result->fetch_assoc();
} else {
    $player_info = array("error" => "Player not found");
}

// Return the player information as JSON
header('Content-Type: application/json');
echo json_encode($player_info);
?>