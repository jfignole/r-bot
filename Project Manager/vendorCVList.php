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
$id = $_GET['id'];
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
      Vendor CV List
    </title>
  </head>
  <body class="emp">
    <b><u>Vendor CVs</b></u>
    <br/>
  </body>
  </html>
  <?php
require_once("../class/vendors.php");
#$rowt = array(array());
try{
    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sqlt = "SELECT * FROM vendor WHERE so_number = '$id'";
    $stmtt = $conn->prepare($sqlt);
    $stmtt->execute();
    $rowt = $stmtt->fetchAll(PDO::FETCH_NUM&PDO::FETCH_ASSOC);
    #lists Vendor CVs by name
    foreach($rowt as $test) {
        if(is_array($test))
        {
            $idt = $test['V_ID'];
            $nmt = $test['name'];
            $smt = $test['so_number'];
            echo "<a href='vendorCV.php?id=$idt'>".$id.": ".$nmt."</a><br/>";
        }
    }
}catch(PDOException $e){
    echo $e->getMessage();
}
?>