<?php
$toemail = "skhezr@lakeheadu.ca";
$subject = "IM315 - Week 9";
$body = "Hello Nima, This is test email send by PHP code!";
$headers = "From: nkhezr@gmail.com";

if (mail($toemail, $subject, $body, $headers)){
  echo "Email successfully sent to $toemail";
}else{
  echo "Email sending failed ....";
}

 ?>
