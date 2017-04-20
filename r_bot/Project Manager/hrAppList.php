<?php /**
* @package r_bot
* @author Jonathan Fignole <jonathan.fignole@cgi.com>
* @copyright  2017 CGI Group Inc.
*/
session_start();
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
<head>
	<link rel='stylesheet' href='../styles.css' type='text/css'>
  <ul> <!--Menu-->
  <li><a>R-BOT</a></li>
  <li><a href='home.php' style = "font-size:14px">Home</a></li>
  <li><a href="RM_Form.php" style ="font-size:14px">New RM_Form</a></li>
  <li><a href="vendorCVList.php" style = "font-size:14px">Vendor CVs</a></li>
  <li><a href="vendorCVUpload.php" style = "font-size:14px">Uploaded Vendor CVs</a></li>
  <li><a href="../logout.php" style="font-size:14px">Logout</a></li>
  </ul>
	<title>
	Pending RM_Forms
	</title>
</head>
	<body class="emp">
    <h1>CGI</h1>
    <h2>R-Bot</h2>
    <b><u>Pending RM Forms</b></u><br/>
  </body>
</html>
<?php
require_once("../class/rmClass.php");
$date = array(array());
$date = rmClass::fillForm($date);
#lists RM Forms available by date filled out
foreach($date as $test) {
	if(is_array($test))
	{
		$id = $test['RM_ID'];
		$nm = $test['so_number'];
	echo "<a href='HR_AP_RM_Form.php?id=$id'>".$nm."</a><br/>";
	}
}
?>
