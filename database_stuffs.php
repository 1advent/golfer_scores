<?php
// Load environment variables
$dotenv = fopen('.env', 'r');
echo $dotenv;
while (!feof($dotenv)) {
  $line = trim(fgets($dotenv));
  if ($line && strpos($line, '=') !== false) {
    list($key, $value) = explode('=', $line, 2);
    $_ENV[$key] = $value;
  }
}
fclose($dotenv);

// Set up database connection
$host = $_ENV['DB_HOST'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];
$database = $_ENV['DB_DATABASE'];

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>