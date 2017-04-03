<?php
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
<head>
	<link rel='stylesheet' href='../styles.css' type='text/css'>
  <ul> <!--Menu-->
  <li><a>R-BOT</a></li>
  <li><a href='home.php' style = "font-size:14px">Home</a></li>
  <li><a href="RM_Form.php" style ="font-size:14px">New RM_Form</a></li>
  <li><a href="hrAppList.php" style = "font-size:14px">HR Approved List</a></li>
  <li><a href="vendorCVUpload.php" style = "font-size:14px">Uploaded Vendor CVs</a></li>
  <li><a href="../logout.php" style="font-size:14px">Logout</a></li>
  </ul>
	<title>
	Vendor CV List
	</title>
</head>
	<body>
    <h1>CGI</h1>
    <h2>R-Bot</h2>
    <b><u>Vendor CVs</b></u><br/>
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
	echo "<a href='vendorCV.php?id=$idt'>".$smt.": ".$nmt."</a><br/>";
	}
}
?>
