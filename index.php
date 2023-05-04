<?php 
$page_name="Home";
require('header.php'); ?>
List of results:
<?php
$sql = "SELECT * FROM golfer_data";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  echo "<table class='table table-striped'><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Score</th></tr>";
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row["id"]."</td><td>".$row["first_name"]."</td><td>".$row["last_name"]."</td><td>".$row["score"]."</td></tr>";
  }
  echo "</table>";
} else {
  echo "0 results";
}
?>

<?php require('footer.php'); ?>