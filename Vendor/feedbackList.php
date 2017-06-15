<?php /**
* @package r_bot
* @author Jonathan Fignole <jonathan.fignole@cgi.com>
* @author Tyler Patrick Steve <tyler.p.steve@cgi.com>
* @copyright  2017 CGI Group Inc.
*/
session_start();// session_start();
if(!isset($_SESSION['vend'])) // If session is not set, user isn't logged in.
// Redirect to Login Page
{
    header("Location:../logout.php");
    exit();
}
// Include PHP -> DB config file
include("../config.php");
?>
<!-- Begin HTML -->
  <!DOCTYPE html>
  <html>
  <header>
    <center><img src="/images/banner_main.png" alt="Banner">
      <center>
  </header>
  <head>
    <link rel='stylesheet' href='../styles.css' type='text/css'>
    <div class="container">
      <a href="vendorHome.php">Home</a>
      <a href="../logout.php">Logout</a>
    </div>
    <title>
      Vendor CV List
    </title>
  </head>
  <body class="vndr">
    <table>
      <tr>
        <caption>SO-NUMBERS*</caption>
      </tr>
      <tr>
  <?php
    require_once("../class/vendors.php"); // DB query script file
    $rowt = array(array()); // Create an empty array named $rowt
    $rowt = vendors::fillForm($rowt); // fill $rowt with data from vendors.php -> fillForm script
    // lists Vendor CVs by name
    $arr = array();
    foreach($rowt as $test) {
        if(is_array($test))
        {
            $arr[] = $test['so_number']; // so_number inserted into array for sort
        }
    }
    $unique_data = array_unique($arr);
    foreach($unique_data as $val)
    {
      echo "<td><a href='feedback.php?id=$val'>".$val."</a><br/></td>"; // output the name and so_number to link to feedback
    }
  ?>
  </tr>
  </table>
  <center>
    <div id="footer">
      <h4>*Click a SO-NUMBER to view all current feedback per SO-NUMBER</h4>
    </div>
  </center>
   </body>
  </html>