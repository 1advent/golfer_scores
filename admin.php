<?php
$page_name = "Scorecard";
require('header.php');

//make a new player:
?>
<form action="admin.php" method="post">
<label for="player">New Player Name:</label>
<input type="text" name="newplayer" id="newplayer" value="John Doe/Jane Doe">
<input type="submit" value="Add Player">
<br>
<?php
$players = array(
  "John Doe/Jane Doe",
  "Mike Smith/Mary Smith",
  "Anthony Jones/Anne Jones"
);

if (isset($_POST['player']) && isset($_POST['scores'])) {
  $player = $_POST['player'];
  $scores = $_POST['scores'];

    //check if player exists
    $sql = "SELECT * FROM golfer_data WHERE player='$player'";
    $result = $conn->query($sql);
    //make a new row if they do not
    if ($result->num_rows == 0) {
      $sql = "INSERT INTO golfer_data (player, scores) VALUES ('$player', '$scores')";
      if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }
    //update the record based on the player_name
    $sql = "UPDATE golfer_data SET scores='$scores' WHERE player='$player'";
    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

  echo "Scores saved for $player";
} else {
  // show the scorecard form
  echo "<form method='post'>";
  echo "<select name='player'>";
  foreach ($players as $player) {
    echo "<option value='$player'>$player</option>";
  }
  echo "</select>";

  for ($i = 1; $i <= 18; $i++) {
    echo "<p>Hole $i:</p>";
    echo "<label>Golfer Score: <input type='number' name='scores[$i][golferScore]' /></label>";
    echo "<label>9-Hole Handicap: <input type='number' name='scores[$i][nineHandicap]' /></label>";
    echo "<label>Handicap: <input type='number' name='scores[$i][handicap]' /></label>";
    echo "<label>Par: <input type='number' name='scores[$i][par]' /></label>";
  }

  echo "<input type='submit' value='Submit Scores' />";
  echo "</form>";
}

require('footer.php');
?>
