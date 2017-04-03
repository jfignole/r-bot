<?php
session_start();
if(!isset($_SESSION['emp'])) #If session is not set, user isn't logged in.
                             #Redirect to Login Page
       {
           header("Location:../logout.php");
           exit();
       }
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Home</title>
<link rel="stylesheet" href="../styles.css" type="text/css" />
<ul> <!--Menu-->
<li><a>R-BOT</a></li>
<li><a href="RM_Form.php" style ="font-size:14px">New RM_Form</a></li>
<li><a href="hrAppList.php" style = "font-size:14px">HR Approved List</a></li>
<li><a href="vendorCVList.php" style = "font-size:14px">Vendor CVs</a></li>
<li><a href="vendorCVUpload.php" style = "font-size:14px">Uploaded Vendor CVs</a></li>
<li><a href="../logout.php" style="font-size:14px">Logout</a></li>
</ul>
</head>
<h1>CGI</h1>
<h2>R-BOT</h2>
<body>
<?php echo "<b>Welcome to the Employee Page!</b>";
      $SESS_ID = "set";?>

<br/>

</body>
</html>
