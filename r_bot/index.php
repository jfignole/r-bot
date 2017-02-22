<?php
 include_once("config.php");
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
        <table>
          <form method="post" action="">
        	<tr><td colspan="2" id=t1><h2>Login</h2></td></tr>
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

  if( $usr->userLogin() ) {

    echo "Welcome";
     if($usr->user_type == "Vendor") {
      header("Location:vendorHome.php");
    }
    else if($usr->user_type == "HR"){
    header("Location:hrHome.php");
}
  else {
    header("Location:home.php");
  }
}
else {
    echo "Incorrect Username/Password";
  }
}
?>
