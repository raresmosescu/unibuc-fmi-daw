<?php

$ip = $_SERVER['REMOTE_ADDR'];

if ($_SERVER['HTTP_HOST']=='localhost') {
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "store";
} else {
    $dbhost = "sql200.epizy.com";
    $dbuser = "epiz_33128903";
    $dbpass = "YFgsAZ7XBm9bv";
    $dbname = "epiz_33128903_store";
}


// Connect to the database
$db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// Check the connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";
?>
