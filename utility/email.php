<?php

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer\PHPMailer\PHPMailer();

//SMTP settings
$mail->isSMTP();
$mail->Host = 'smtp.example.com';
$mail->SMTPAuth = true;
$mail->Username = 'your_username';
$mail->Password = 'your_password';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

function createAndSendEmail($email, $name, $to_email, $to_name, $subject, $body) {
  global $mail;
  //Email settings
  $mail->setFrom($email, $name);
  $mail->addAddress($to_email, $to_name);
  $mail->Subject = $subject;
  $mail->Body = $body;

  if ($mail->send()) {
    return 'Email sent successfully.';
  } else {
    return 'Error: ' . $mail->ErrorInfo;
  }
}

