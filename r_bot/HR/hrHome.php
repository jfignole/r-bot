<?php session_start();
if(!isset($_SESSION['hr']))#If session is not set, user isn't logged in.
                            #Redirect to Login Page
       {
           header("Location:../logout.php");
           exit();
       } ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Home</title>
<link rel="stylesheet" href="../styles.css" type="text/css" />
</head>
<ul>
<li><a>R-BOT</a></li>
<li><a href="pend_RM_Forms.php" style ="font-size:14px">Pending RM Form</a></li>
<li><a href="../logout.php" style="font-size:14px">Logout</a></li>
</ul>
<h1>CGI</h1>
<h2>R-Bot</h2>
<body>
Welcome to the HR Page!

</body>
</html>
