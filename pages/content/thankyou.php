<?php

  require('controllers/invoice.php');

  if(isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
  } elseif (isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
  } else {
    // Show an error message or redirect to an error page
    exit();
  }

  $pdf = new PDF_Invoice();
  $data = $pdf->LoadData($order_id);

  $pdf->AddPage();
  $pdf->BasicTable($data);

  $pdf->Output('F', 'invoices/invoice_'.$order_id.'.pdf');

?>

<div>
  <h1>Thank you for your order!</h1>
  <p>Your order number is: <?php echo $_GET['order_id']; ?></p>
  <a href="invoices/invoice_<?php echo $_GET['order_id']; ?>.pdf" download>Download Invoice</a>
</div>
