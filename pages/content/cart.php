
<?php include("models/product.php"); ?>

  <div class="container">
    <h1>Cart</h1>
    <table class="table">
      <thead>
        <tr>
          <th>Product Name</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach ($products as $product) {
            echo "<tr>";
            echo "<td>" . $product['name'] . "</td>";
            echo "<td>" . $product['price'] . "</td>";
            echo "<td>" . $product['quantity'] . "</td>";
            echo "<td>" . $product['price'] * $product['quantity'] . "</td>";
            echo "</tr>";
          }
        ?>
      </tbody>
    </table>
  </div>
