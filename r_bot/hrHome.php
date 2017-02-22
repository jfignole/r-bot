<?php
session_start();
//if(!session_is_registered(username)){
  //header("location:index.php");
//}
include("class/user.php");
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Home</title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<h1>CGI</h1>
<body>
<?php echo "Welcome to the HR Page!"?>

<br/>
<a href="HR_RM_Form.php" style ="font-size:14px">RM Form</a>
<a href="logout.php" style="font-size:14px">Logout?</a>
</body>
</html>
