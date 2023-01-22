<?php
  require("database.php");

  function createOrder($email, $total, $address, $status) {
    global $db;
    // validate inputs
    $email = mysqli_real_escape_string($db, $email);
    $total = mysqli_real_escape_string($db, $total);
    $address = mysqli_real_escape_string($db, $address);
    $status = mysqli_real_escape_string($db, $status);
    // Insert new order into database using prepared statement
    $stmt = $db->prepare("INSERT INTO `order` (email, total, address, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdss", $email, $total, $address, $status);
    $stmt->execute();
    // Get the last inserted ID
    $order_id = $db->insert_id;
    $stmt->close();
    //Return the order number
    return $order_id;
  }

  function readOrder($order_id) {
    global $db;
    // validate inputs
    $order_id = mysqli_real_escape_string($db, $order_id);
    // Retrieve order from database using prepared statement
    $stmt = $db->prepare("SELECT * FROM `order` WHERE order_id = ?");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $order = $result->fetch_assoc();
    $stmt->close();
    return $order;
  }

  function updateOrder($order_id, $user_id, $product_id, $quantity, $address, $status) {
    global $db;
    // validate inputs
    $order_id = mysqli_real_escape_string($db, $order_id);
    $user_id = mysqli_real_escape_string($db, $user_id);
    $product_id = mysqli_real_escape_string($db, $product_id);
    $quantity = mysqli_real_escape_string($db, $quantity);
    $address = mysqli_real_escape_string($db, $address);
    $status = mysqli_real_escape_string($db, $status);
    // Update order in database using prepared statement
    $stmt = $db->prepare("UPDATE `order` SET user_id = ?, product_id = ?, quantity = ?, address = ?, status = ? WHERE order_id = ?");
    $stmt->bind_param("iiissi", $user_id, $product_id, $quantity, $address, $status, $order_id);
    $stmt->execute();
    $stmt->close();
  }

  function deleteOrder($order_id) {
    global $db;
    // validate inputs
    $order_id = mysqli_real_escape_string($db, $order_id);
    // Delete order from database using prepared statement
    $stmt = $db->prepare("DELETE FROM `order` WHERE order_id = ?");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $stmt->close();
  }

  function getUserOrders($email) {
    global $db;
    $stmt = $db->prepare("SELECT * FROM `order` WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $orders = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $orders;
  }

  function getAllOrders($recentFirst=false) {
    global $db;
    if ($recentFirst == true) {
      $result = $db->query("SELECT * FROM `order` ORDER BY created_at DESC");
    } else {
      $result = $db->query("SELECT * FROM `order`");
    }
    $orders = $result->fetch_all(MYSQLI_ASSOC);
    return $orders;
  }

?>
