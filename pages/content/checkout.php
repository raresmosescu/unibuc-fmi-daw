<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process the form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $credit_card = $_POST["credit-card"];
    $order_total = $_SESSION["cart_total"];
    $status = "pending";
    $cart = $_SESSION["cart"];

    $order_id = createOrder($email, $order_total, $address, $status);
    createOrderItemsFromCart($order_id);

    unset($_SESSION['cart']);

    // Redirect to thankyou.php
    header("Location: thankyou.php?order_id=".$order_id);
    exit;
  }

?>
<div class="container mt-4">
  <div class="row">
    <div class="col-md-8">
      <form method="POST" action="checkout.php">
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
          <label for="address">Billing Address:</label>
          <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="form-group">
          <label for="credit-card">Credit Card:</label>
          <input type="text" class="form-control" id="credit-card" name="credit-card" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit Order</button>
      </form>
    </div>
    <div class="col-md-4" style="padding: 20px; background-color: #f8f9fa;">
      <h3>Order Total: <?php echo "$" . $_SESSION['cart_total'] ?></h3>
    </div>
  </div>
</div>
