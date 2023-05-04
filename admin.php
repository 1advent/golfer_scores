<?php 
$page_name = "Admin";
require('header.php');

if (isset($_POST["password"])) {
  //set cookie
  setcookie("password", $_POST["password"]);
} else if (isset($_COOKIE["password"])) {
  //check cookie
  $_POST["password"] = $_COOKIE["password"];
}

//check password = "secretPassWORD" from POST
if (isset($_POST["password"]) && $_POST["password"] == "secretPassWORD") {
  //show admin page
  echo "Welcome Admin";
} else {
  //show password form
  echo "Please Enter Password:";
  echo "<form action='admin.php' method='post'>";
  echo "<input type='password' name='password'>";
  echo "<input type='submit'>";
  echo "</form>";
}

require('footer.php');
?>
