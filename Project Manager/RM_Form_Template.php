<?php /**
* @package r_bot
* @author Jonathan Fignole <jonathan.fignole@cgi.com>
* @copyright  2017 CGI Group Inc.
*/
session_start();#session_start();
if(!isset($_SESSION['emp'])) #If session is not set, user isn't logged in.
#Redirect to Login Page
{
    header("Location:../logout.php");
    exit();
}
include("../config.php");
?>
  <!DOCTYPE html>
  <html>
  <header>
    <center><img src="/images/banner_main.png" alt="Banner">
      <center>
  </header>

  <head>
    <link rel='stylesheet' href='../styles.css' type='text/css'>
    <div class="container">
      <a href="home.php">Home</a>
      <a href="../logout.php">Logout</a>
    </div>
    <title>
      RM Form Templates
    </title>
  </head>

  <body class="emp">
    <br/>
    <table>
    <caption>RM_FORM TEMPLATES</caption>
    <tr>
      <th>ID</th>
      <th>POSITION TITLE</th>
    </tr>
    <tr>
  <?php
require_once("../class/template.php");
#$rowt = array(array());
try{
    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sqlt = "SELECT * FROM templates";
    $stmtt = $conn->prepare($sqlt);
    $stmtt->execute();
    $rowt = $stmtt->fetchAll(PDO::FETCH_NUM&PDO::FETCH_ASSOC);
    #lists Vendor CVs by name
    foreach($rowt as $test) {
        if(is_array($test))
        {
            echo "<td>" . $idt = $test['ID'] . "</td>";
            $nmt = $test['position_title'];
            echo "<td><a href='tempRM_Form.php?id=$idt'>" . $nmt . "</a></td></tr><br/>";
        }
    }
}catch(PDOException $e){
    echo $e->getMessage();
}
?>
</table>
    </body>
  </html>