<?php
$page_name = "Scorecard";
require('header.php');

$players = array(
  "John Doe/Jane Doe",
  "Mike Smith/Mary Smith",
  "Anthony Jones/Anne Jones"
);

if (isset($_POST['player']) && isset($_POST['scores'])) {
  $player = $_POST['player'];
  $scores = $_POST['scores'];

    // save the scores
    $sql = "INSERT INTO scorecard (player, scores) VALUES ('$player', '$scores')";

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
