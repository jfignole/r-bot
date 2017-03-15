<?php
/*Checks whether the session is already there or not. If the user is logged in
  already, then the session is there, if not then its not there. If it is true
  then header redirects the user to the correct homepage depending on the user_type*/
 session_start();
 
 include_once("config.php");
 if(isset($_SESSION['use']))
  {
    if($usr->user_type == "Vendor") {
   header("Location:Vendor/vendorHome.php");
 }
 else if($usr->user_type == "HR"){
 header("Location:HR/hrHome.php");
}
else {
 header("Location:Employee/home.php");
}
}

 ?>
 <?php if ( !(isset($_POST['login'] ) ) ) { ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="styles.css"/>
    </head>

    <body>
      <h1>CGI</h1>
      <h2>R-Bot</h2>
        <table>
          <form method="post" action="">
        	<tr><td colspan="2" id=t1><h3>Login</h3></td></tr>
          <tr>
              <th><b>Username:</b></th>
              <td><input type="text" maxlength="30" placeholder="Enter username" name="username" required autofocus></td>
          </tr>
          <tr>
              <th><b>Password:</b></th>
              <td><input type="password" maxlength="30" placeholder="Enter password" name="password" required></td>
          </tr>
          <tr>
              <th><b>User Type:</b></th>
              <td><select name="user_type" >
                  <option>Employee</option>
                  <option>HR</option>
                  <option>Vendor</option>
                </select></td>
          </tr>
          <tr>
              <td><input type="submit" name="login" class="log" value="Login"  ></td>
              <td><input type="button" name="register" class="log" value="Register" onclick="location.href='register.php'"/></td>
          </tr>
            </form>
        </table>
    </body>
</html>

<?php
} else {
  $usr = new Users;
  $usr->storeFormValues( $_POST );
  #passes user through the user class for validation checks user type
  if( $usr->userLogin() ) {

    echo "Welcome";
     if($usr->user_type == "Vendor") {
       $_SESSION['vend']='set';
      header("Location:Vendor/vendorHome.php");
    }
    else if($usr->user_type == "HR"){
      $_SESSION['hr']='set';
    header("Location:HR/hrHome.php");
}
  else {
    $_SESSION['emp']='set';
    header("Location:Employee/home.php");
  }
}
else {
    echo "Incorrect Username, Password, or User Type. Please Try<a href='index.php'> Again</a>";

  }
}
?>
