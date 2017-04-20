<?php /**
* @package r_bot
* @author Jonathan Fignole <jonathan.fignole@cgi.com>
* @copyright  2017 CGI Group Inc.
*/
session_start();#session_start();
if(!isset($_SESSION['vend'])) #If session is not set, user isn't logged in.
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
  <ul>
  <li><a>R-BOT</a></li>
  <li><a href="vendorHome.php" style= "font-size:14px">Home</a></li>
  <li><a href="rm_request_list.php" style ="font-size:14px">RM_Form List</a></li>
  <li><a href="../logout.php" style="font-size:14px">Logout</a></li>
  </ul>
	<title>
	Vendor CV List
	</title>
</head>
	<body class="vndr">
    <h1>CGI</h1>
    <h2>R-Bot</h2>
    <b><u>Feedback</b></u><br/>
  </body>
</html>
<?php
require_once("../class/vendors.php");
$rowt = array(array());
$rowt = vendors::fillForm($rowt);
#lists Vendor CVs by name
foreach($rowt as $test) {
	if(is_array($test))
	{
		$idt = $test['V_ID'];
		$nmt = $test['name'];
    $smt = $test['so_number'];
	echo "<a href='feedback.php?id=$idt'>".$smt.": ".$nmt."</a><br/>";
	}
}
?>
