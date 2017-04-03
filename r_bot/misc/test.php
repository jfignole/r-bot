<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
//if "email" variable is filled out, send email
  if (isset($_POST['email']))  {


      try {
          $message = new Message($mail_options);
          $message->send();
          echo $message;
      } catch (InvalidArgumentException $e) {
        echo $e->getMessage();
      }

      //Email information
      $from = $_POST['from'];
      $to = $_POST['to'];
      $subject = $_POST['subject'];
      $message = $_POST['message'];
      $message = wordwrap($message, 80, "\r\n");
      //send email
      mail($to, "$subject", $message, "From:" . $from);

      //Email response

      echo "Thank you for contacting us!";

        //if "email" variable is not filled out, display the form

    } else { ?>
    <!DOCTYPE html>
    <html>
    <head>
    <meta charset="utf-8">
    <title>Home</title>
    <link rel="stylesheet" href="styles.css" type="text/css" />
    </head>
    <h1>CGI</h1>
    <h2>R-BOT</h2>
    <body>
      <table>
     <form class="email" method="post">
       <tr><th>To: </th></tr>
       <tr><td><input name="to" type="text" /></td></tr>
       <tr><th>From: </th></tr>
       <tr><td><input name="from" type="text" ></td></tr>
       <tr><th>Subject: </th></tr>
       <tr><td><input name="subject" type="text" /></td></tr>
       <tr><th>Message:</th></tr>
       <tr><td><textarea name="message" rows="15" cols="40"></textarea></td></tr>
       <tr><td><input type="submit" value="Submit" style="float: right"/></td></tr>
      </form>
    </table>
    </body>
    </html>
    <?php
  }
?>
