<?php
session_start();
if(!isset($_SESSION['vend'])) #If session is not set, user isn't logged in.
                             #Redirect to Login Page
       {
           header("Location:../index.php");
       }
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Home</title>
<link rel="stylesheet" href="../styles.css" type="text/css" />
</head>
<ul>
<li><a href="rm_request_list.php" style ="font-size:14px">Vendor Form</a></li>
<li><a href="../logout.php" style="font-size:14px">Logout?</a></li>
<li><a>R-BOT</a></li>
</ul>
<h1>CGI</h1>
<h2>R-Bot</h2>
<body>
<?php echo "Welcome to the Vendor Page!"?>

<br>

</body>
</html>
