<?php
session_start();
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
	<title>
	Pending RM_Forms
	</title>
</head>
	<body>
    <h1>CGI</h1>
    <h2>R-Bot</h2>
    <b><u>Pending RM Forms</b></u>
  </body>
</html>
<?php
require_once("../class/rmClass.php");
$rowt = array(array());
$rowt = rmClass::fillForm($rowt);
#lists RM forms available by date filled out
foreach($rowt as $test) {
	if(is_array($test))
	{
		$id = $test['RM_ID'];
		$nm = $test['so_number'];
	echo "<a href='vendorForm.php?id=$id'>".$nm."</a><br/>";
	}
}

echo "<a href='vendorHome.php'>Back</a> <a href='../logout.php'>Logout</a>";
?>
