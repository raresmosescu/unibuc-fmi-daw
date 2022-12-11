<?php
  // check if the cart exists in the session
  if (!isset($_SESSION['cart'])) {
    // if not, create an empty cart
    $_SESSION['cart'] = array();
  }

  ?>
  <div class="container mt-5">
    <h1>Cart</h1>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Product</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $total = 0;
        // load cart items from the session
        $cart_items = $_SESSION['cart'];
        foreach ($cart_items as $item) {
          // calculate total price for each item
          $item_total = $item['quantity'] * $item['price'];
          $total += $item_total;
          echo "<tr>";
          echo "<td>" . $item['name'] . "</td>";
          echo "<td>" . $item['quantity'] . "</td>";
          echo "<td>$" . $item['price'] . "</td>";
          echo "<td>$" . $item_total . "</td>";
          echo "</tr>";
        }
        $_SESSION['cart_total'] = $total;
        ?>
      </tbody>
    </table>
    <h3>Total: $<?php echo $total; ?></h3>
    <div class='d-flex'>
      <a href="checkout.php" class="btn btn-primary mr-2">Checkout</a>
      <form action='/unibuc-fmi-daw/controllers/empty_cart.php' method='POST'>
        <input class='btn btn-danger flex-fill me-1' data-mdb-ripple-color='dark' type='submit' value='Empty Cart'>
      </form
      </div>
  </div>