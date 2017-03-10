<?php
session_start();
if(!isset($_SESSION['hr'])) #If session is not set, user isn't logged in.
                             #Redirect to Login Page
       {
           header("Location:../index.php");
       }
?>
<?php
include("../config.php");

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="../styles.css">
	<title>
	Pending RM_Forms
	</title>
</head>
	<body>
    <h1>CGI</h1>
    <h2>R-Bot</h2>
    <p><b><u>Pending RM Forms</b></u></p>
  </body>
</html>
<?php
require_once("../class/rmClass.php");
$rowt = array(array());
$rowt = rmClass::fillForm($rowt);

foreach($rowt as $test) {
	if(is_array($test))
	{
		$id = $test['RM_ID'];
		$nm = $test['lastUpdated'];
    $pt = $test['position_title'];
	echo "<a href='HR_RM_Form.php?id=$id'>".$pt.": ".date('M j Y', strtotime($nm))."</a><br/>";#passes id of clicked link
	}
}
echo "<a href='hrHome.php'>Back</a>";

?>
