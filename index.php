<?php 
$page_name="Home";
require('header.php'); ?>
List of results:
<?php
$sql = "SELECT * FROM golfer_data order by score desc";
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