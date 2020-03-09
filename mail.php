<?php
$to_email = "maxyeh666@gmail.com";
$subject = "寄信範本" . date("Y-m-d H:i:s",strtotime("now"));
$body = "信件內容";
// $headers = "From: sender\'s email";

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

if(mail($to_email, $subject, $body, $headers)){
  echo "Email successfully sent to {$to_email}..." . "<br/>";
  echo $subject;
}else{
  echo "Email sending failed...";
}