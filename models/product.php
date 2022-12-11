<?php

include("data/database.php");
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

function fetch_products() {
  global $hostname, $username, $password, $database;
  $db = mysqli_connect($hostname, $username, $password, $database);

  // Query the database to get all products
  $query = "SELECT * FROM product;";
  $result = mysqli_query($db, $query);

  // Loop through the query results and store each product in an array
  $products = array();
  // while ($row = mysqli_fetch_assoc($result)) {
  //   $products[] = $row;
  // }

  return $products;
}

?>