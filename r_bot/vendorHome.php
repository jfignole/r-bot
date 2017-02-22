<?php
session_start();
//if(!session_is_registered(username)){
  //header("location:index.php");
//}
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
<?php echo "Welcome to the Vendor Page!"?>

<br>
<a href="vendorForm.php" style ="font-size:14px">Vendor Form</a>
<a href="logout.php" style="font-size:14px">Logout?</a>
</body>
</html>
