<?php
  if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $to = 'raresmose@gmail.com';
    $headers = "From: ".$email;
    $txt = "You have received an email from ".$name.".\n\n".$message;

    mail($to, $subject, $txt, $headers);
    header("Location: contact.php?mailsend");
  }
?>
<h1>Contact us</h1>
<br>
<form method="post" action="">
  <input type="text" name="name" placeholder="Name" required><br><br>
  <input type="email" name="email" placeholder="Email" required><br><br>
  <input type="text" name="subject" placeholder="Subject" required><br><br>
  <textarea name="message" placeholder="Message" required></textarea><br><br>
  <input type="submit" name="submit" value="Send">
</form>
<?php
  if (isset($_GET['mailsend'])) {
    echo "Your email has been sent!";
  }
?>