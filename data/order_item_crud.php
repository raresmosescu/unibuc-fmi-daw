<?php
  require("database.php");

function createOrderItemsFromCart($order_id) {
    global $db;
    // Iterate through the cart and insert each item as a new order item
    foreach ($_SESSION['cart'] as $item) {
      $product_id = mysqli_real_escape_string($db, $item['id']);
      $product_name = mysqli_real_escape_string($db, $item['product_name']);
      $quantity = mysqli_real_escape_string($db, $item['quantity']);
      $price = mysqli_real_escape_string($db, $item['price']);
      $stmt = $db->prepare("INSERT INTO `order_item` (order_id, product_id, product_name, quantity, price) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param("iisid", $order_id, $product_id, $product_name, $quantity, $price);
      $stmt->execute();
      $stmt->close();
    }
  }
  
  function readOrderItemsFromOrderId($order_id) {
    global $db;
    // validate inputs
    $order_id = mysqli_real_escape_string($db, $order_id);
    // Retrieve order items from database using prepared statement
    $stmt = $db->prepare("SELECT * FROM order_item WHERE order_id = ?");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $order_items = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $order_items;
  }

