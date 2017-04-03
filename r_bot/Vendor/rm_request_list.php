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
  <ul>
  <li><a>R-BOT</a></li>
  <li><a href="vendorHome.php" style= "font-size:14px">Home</a></li>
  <li><a href="feedbackList.php" style="font-size:14px">Feedback</a></li>
  <li><a href="../logout.php" style="font-size:14px">Logout</a></li>
  </ul>
	<title>
	Pending RM_Forms
	</title>
</head>
	<body>
    <h1>CGI</h1>
    <h2>R-Bot</h2>
    <b><u>Pending RM Forms</b></u><br/>
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
?>
