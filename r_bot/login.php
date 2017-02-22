<?php
 //Establishing connection with our database

error_reporting(E_ALL ^ E_DEPRECATED);
$db=mysqli_connect('localhost:3306','root','', 'r_bot');
//mysql_select_db("r_bot") or die("Cannot select DB");

if ($db->connect_errno) {
       echo "<p>MySQL error no {$db->connect_errno} : {$db->connect_error}</p>";
       exit();
   }
ini_set('display_errors', 1);
$error = ""; //Variable for storing our errors.

if(isset($_POST["submit"]))
{
if(empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["uType"]))
{
$error = "All three fields are required.";
}else
{// To protect from MySQL injection
  $username = $_POST['username'];
  $password = $_POST['password'];
  $usertype = $_POST['uType'];
  $username = stripslashes($username);
  $password = stripslashes($password);
  $usertype = stripslashes($usertype);

$username = mysqli_real_escape_string($db, $username);
$password = mysqli_real_escape_string($db, $password);
//$password = md5($password);
$usertype = mysqli_real_escape_string($db, $usertype);
$saltQuery = mysqli_query($db, "select salt from user where username = '$username'");
//Check username and password from database
$result = mysqli_query($db, $saltQuery);
echo $result;
$row = mysqli_fetch_assoc($result);
$salt = $row['salt'];
$saltedPwd = $password . $salt;
$hashedPwd = hash('sha256', $saltedPwd);
$query = "select * from user where username='$username' and password = '$hashedPwd";
$result = mysqli_query($db, $query);
$row = mysqli_fetch_array(mysqli_result, MYSQLI_ASSOC);
$active = $row['active'];
$count = mysqli_num_rows($result);
//$result = mysqli_query($db, $query);

if($count == 1){
  echo "Logged in successfully";
  session_register("username");
  $_SESSION['login_user'] = $username;
  session_register("password");
  mysqli_free_result($result);
  if($usertype == "Vendor") {
    header("Location:vendorHome.php");
  }
  else {
  header("Location:home.php");
}
} else {
  echo "Invalid username/password combination";
}
}
}

?>
