<?php /**
* @package r_bot
* @author Jonathan Fignole <jonathan.fignole@cgi.com>
* @copyright  2017 CGI Group Inc.
*/
include_once("config.php");
if(!(isset($_POST['register']))) { ?>
  <!DOCTYPE html>
  <html>
  <header>
    <center><img src="/images/banner_main.png" alt="Banner">
      <center>
  </header>
  <head>
    <link rel='stylesheet' href='styles.css' type="text/css">
    <title>Registration Form</title>
  </head>
  <body>
    <table align="center">
      <form method="POST">
        <tr>
          <th><b>First Name:</b></th>
          <td>
            <input type="text" maxlenth="30" required autofocus name="first_name" />
          </td>
        </tr>
        <tr>
          <th><b>Last Name:</b></th>
          <td>
            <input type="text" maxlenth="30" required name="last_name" />
          </td>
        </tr>
        <tr>
          <th><b>Username:</b></th>
          <td>
            <input type="text" maxlenth="30" required name="username" />
          </td>
        </tr>
        <tr>
          <th><b>Email:</b></th>
          <td>
            <input type="text" maxlenth="30" required name="email" />
          </td>
        </tr>
        <tr>
          <th><b>Password:</b></th>
          <td>
            <input type="password" maxlenth="30" required name='password' />
          </td>
        </tr>
        <tr>
          <th><b>Confirm Password:</b></th>
          <td>
            <input type="password" maxlength="30" required name="conpassword" />
            <tr>
              <th><b>User Type:</b></th>
              <td>
                <select name='user_type'>
                  <option value=''>Select...</option>
                  <option value='Project Manager'>Project Manager</option>
                  <option value='HR'>HR</option>
                  <option value='Vendor'>Vendor</option>
                </select>
              </td>
            </tr>
            <tr>
              <td colspan='2'>
                <input type='submit' name='register' value='Register' />
                <input type='button' name="cancel" value="Cancel" onclick="return goBack()" />
                <script>
                  function goBack() {
                    window.location.href = "/Project Manager/home.php";
                  }
                </script>
              </td>
            </tr>
      </form>
    </table>
  </body>
  </html>
  <?php
} else {
    $usr = new Users;
    $usr->storeFormValues( $_POST );
    #checks that passwords match then registers user in the database
    if( $_POST['password'] == $_POST['conpassword'] ) {
        $email = $_POST["email"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script type=\"text/javascript\">
        if (window.confirm('Invalid email format'))
        {
            window.location = 'register.php'
        }else{
            window.location = 'register.php'
        }
        </script> ";
        } else {
            echo $usr->register($_POST);
        }}else {
            echo " <script type=\"text/javascript\">
        if (window.confirm('Password's do not match''))
        {
            window.location = 'register.php'
        }else{
            window.location = 'register.php'
        }
        </script> ";
        }
}
    ?>
  