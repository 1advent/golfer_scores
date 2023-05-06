<?php 
$page_name="Home";
require('header.php'); ?>
List of results:
<?php
$sql = "SELECT golfer_data.players, SUM(week_information.score) as score FROM databasedb.week_information INNER JOIN  golfer_data ON golfer_data.golfer_id = week_information.golfer_id WHERE week_information.score >= 0 GROUP BY golfer_data.players;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  echo "<table class='table table-striped'><tr><th>First Name</th><th>Score</th></tr>";
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row["players"]."</td><td>".$row["score"]."</td></tr>";
  }
  echo "</table>";
} else {
  echo "0 results";
}
?>

<?php require('footer.php'); ?>