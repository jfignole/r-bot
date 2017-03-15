<?php
session_start();#session_start();
if(!isset($_SESSION['vend'])) #If session is not set, user isn't logged in.
                             #Redirect to Login Page
       {
           header("Location:../logout.php");
           exit();
       }
?><?php

include("../config.php");
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="../styles.css">
	<title>
	Vendor CV List
	</title>
</head>
	<body>
    <h1>CGI</h1>
    <h2>R-Bot</h2>
    <p><b><u>Feedback</b></u></p>
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


echo "<a href='vendorHome.php'>Back</a>";
?>
