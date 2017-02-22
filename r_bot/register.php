<?php
include_once("config.php");
?>

<?php if( !(isset( $_POST['register'] ) ) ) { ?>


<!DOCTYPE html>
<html>
  <head>
      <link rel='stylesheet' href='styles.css' type="text/css">
      <title>Registration Form</title>
  </head>
    <body>
      	<h1>CGI</h1>
        <table>
        <form method="post">
          <tr><th><b>First Name:</b></th><td><input type="text" maxlenth="30" required autofocus name="first_name"/></td></tr>
          <tr></tr>
          <tr><th><b>Last Name:</b></th><td><input type="text" maxlenth="30" required  name="last_name"/></td></tr>
          <tr></tr>
          <tr><th><b>Username:</b></th><td><input type="text" maxlenth="30" required  name="username"/></td></tr>
          <tr></tr>
          <tr><th><b>Email:</b></th><td><input type="text" maxlenth="30" required name="email"/></td></tr>
          <tr></tr>
          <tr><th><b>Password:</b></th><td><input type="password" maxlenth="30" required name='password'/></td></tr>
          <tr></tr>
          <tr><th><b>Confirm Password:</b></th><td><input type="password" maxlength="30" required name="conpassword" />
          <tr><th><b>User Type:</b></th>
            <td><select name='user_type'>
            <option value=''>Select...</option>
            <option value='Employee'>Employee</option>
            <option value='HR'>HR</option>
            <option value='Vendor'>Vendor</option>
          </select></td></tr>
          <tr><td colspan='2'><input type='submit' name='register' value='Register' />
            <input type='button' name="cancel" value="Cancel" onclick="location.href='index.php'" /></td></tr>
        </form>
      </table>
    </body>
</html>

<?php
} else {
  $usr = new Users;
  $usr->storeFormValues( $_POST );

  if( $_POST['password'] == $_POST['conpassword'] ) {
    echo $usr->register($_POST);
  } else {
    echo "Password and Confirm password do not match";
  }
}
?>
