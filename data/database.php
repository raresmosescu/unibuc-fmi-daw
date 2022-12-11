<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "store";

// Connect to the database
$conn = mysqli_connect($hostname, $username, $password, $database);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";
?>
