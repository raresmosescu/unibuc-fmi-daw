<?php
$hostname = "localhost";
$username = "my_user";
$password = "my_password";
$database = "my_database";

// Connect to the database
$conn = mysqli_connect($hostname, $username, $password, $database);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>
