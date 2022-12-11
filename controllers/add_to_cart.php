<?php
session_start();

// Initialize the cart array if it doesn't exist
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = array();
} 

// Check if the product already exists in the cart
$productId = $_POST['id'];
$productIndex = -1;

if (!empty($_SESSION['cart'])) {
  foreach ($_SESSION['cart'] as $index => $product) {
    // Check if the product has an 'id' key
    if (isset($product['id'])) {
      // Check if the product id matches the productId variable
      if ($product['id'] == $productId) {
        $productIndex = $index;
        break;
      }
    }
  }
}


// If the product already exists, increment its quantity
if ($productIndex != -1) {
  $_SESSION['cart'][$productIndex]['quantity'] += $_POST['quantity'];
}
// Otherwise, add the product to the cart
else {
  $product = array(
    'id' => $_POST['id'],
    'name' => $_POST['name'],
    'quantity' => $_POST['quantity'],
    'price' => $_POST['price'],
  );
  array_push($_SESSION['cart'], $product);
}

// Echo cart for debugging
// echo (json_encode($_SESSION['cart']));

// Redirect to the cart page
header('Location: ../cart.php');
exit;


