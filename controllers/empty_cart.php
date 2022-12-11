<?php
session_start();

// Initialize the cart array if it doesn't exist
if (isset($_SESSION['cart'])) {
  $_SESSION['cart'] = array();
}

// Redirect to the cart page
header('Location: /unibuc-fmi-daw/cart.php');

exit;