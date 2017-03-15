<?php
$to       = 'jonathan.fignole@gmail.com';
$subject  = 'Testing sendmail.exe';
$message  = 'Hi, you just received an email using sendmail!';
$headers  = 'From: jbfignole@gmail.com' . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=utf-8';

try{if(mail('jonathan.fignole@gmail.com', 'hope this works', 'did it work?', $headers)){
    echo "Email sent";
  }else{catch(PDOException $e)
  {
    echo "Email sending failed";
    echo $e->getMessage();
  }}
?>
