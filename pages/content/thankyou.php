<?php

  require('utility/invoice.php');

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

<?php
// Initialize cURL session
$ch = curl_init();

// Set the API endpoint
curl_setopt($ch, CURLOPT_URL, "https://api.imgflip.com/get_memes");

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the cURL request
$response = curl_exec($ch);

// Close the cURL session
curl_close($ch);

// Decode the JSON response
$data = json_decode($response, true);

// Check if the request was successful
if ($data['success'] == true) {
    // Pick a random meme from the list
    $random_key = array_rand($data['data']['memes']);
    $random_meme = $data['data']['memes'][$random_key];

    // Display the random meme on your website
    echo '<br><br><h2>Here\'s a random meme to show our appreciation (refresh page)</h2>';


    echo '<img style=" display: block; max-width:300px; width: auto; height: auto;" src="' 
    . $random_meme['url'] . '" alt="' . $random_meme['name'] . '" width="' . $random_meme['width']/2 . '" height="' 
    . $random_meme['height']/2 . '">';
    echo '<h3>'. $random_meme['name'] . '</h3>';

} else {
    // Handle the error
    echo $data['error_message'];
}
?>


