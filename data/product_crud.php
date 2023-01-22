<?php
  require("database.php");

  function createProduct($name, $description, $price, $image) {
    global $db;
    // Validate inputs
    $name = mysqli_real_escape_string($db, $name);
    $description = mysqli_real_escape_string($db, $description);
    $price = (double) $price;
    $image = mysqli_real_escape_string($db, $image);
    // Insert product into database using prepared statement
    $stmt = $db->prepare("INSERT INTO product (name, description, price, image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $name, $description, $price, $image);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
  }

  function readProduct($id) {
    global $db;
    // Validate inputs
    $id = (int) $id;
    // Retrieve product from database using prepared statement
    $stmt = $db->prepare("SELECT * FROM product WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();
    return $product;
  }

  function updateProduct($id, $name, $description, $price, $image) {
    global $db;
    // Validate inputs
    $id = (int) $id;
    $name = mysqli_real_escape_string($db, $name);
    $description = mysqli_real_escape_string($db, $description);
    $price = (double) $price;
    $image = mysqli_real_escape_string($db, $image);
    // Update product in database using prepared statement
    $stmt = $db->prepare("UPDATE product SET name = ?, description = ?, price = ?, image = ? WHERE id = ?");
    $stmt->bind_param("ssdsi", $name, $description, $price, $image, $id);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
  }

  function deleteProduct($id) {
    global $db;
    // Validate inputs
    $id = (int) $id;
    // Delete product from database using prepared statement
    $stmt = $db->prepare("DELETE FROM product WHERE id = ?");
    $stmt->bind_param("i", $id);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
  }

  function readAllProducts() {
    /* 
      Returns:
        Associative array (key-value pairs) of the resulted products from mysql query.
      
      Example return value:
        Array (
          [0] => Array (
            [id] => 1,
            [name] => 'Product 1',
            [price] => 19.99,
            [description] => 'This is the first product'
          )
          [1] => Array (
            [id] => 2,
            [name] => 'Product 2',
            [price] => 24.99,
            [description] => 'This is the second product'
          )
          ...
        )
    */ 
    global $db;
    $result = $db->query("SELECT * FROM product");
    // MYSQLI_ASSOC used to return an associative array (key value pairs)
    $products = $result->fetch_all(MYSQLI_ASSOC);
    return $products;
  }

