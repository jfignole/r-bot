<?php
/**
* Login page.
*
* Checks whether the session is already there or not. If the user is logged in
* already, then the session is there, if not then its not there. If it is true
* then header redirects the user to the correct homepage depending on the @var user_type
* allowing a registered user to log in.
*
* @package r_bot
* @author Jonathan Fignole <jonathan.fignole@cgi.com>
* @copyright  2017 CGI Group Inc.
*/
session_start();
include_once("config.php");
if (!(isset($_POST['login']))) {?>
  <!DOCTYPE html>
  <html>
  <header>
    <img src="/images/banner_main.png" alt="Banner">
  </header>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
  </head>

  <body>
    <table align="center">
      <form method="post" action="">
        <tr>
          <td colspan="2" id=t1>
            <h3>Login to R-BOT</h3></td>
        </tr>
        <tr>
          <th><b>Username:</b></th>
          <td>
            <input type="text" maxlength="30" placeholder="Enter username" name="username" required autofocus>
          </td>
        </tr>
        <tr>
          <th><b>Password:</b></th>
          <td>
            <input type="password" maxlength="30" placeholder="Enter password" name="password" required autofocus class="input">
          </td>
        </tr>
        <tr>
          <th><b>User Type:</b></th>
          <td>
            <select name="user_type">
              <option>Project Manager</option>
              <option>HR</option>
              <option>Vendor</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>
            <input type="submit" name="login" class="log" value="Login">
          </td>
          <td>
            <input type="button" name="register" class="log" value="Register New User" onclick="location.href='register.php'" />
          </td>
        </tr>
      </form>
    </table>
  </body>

  </html>
  <?php
} else {
    $usr = new Users;
    /**
    *@param $_POST uses post method to pass user info to check against database for
    * user login and validation
    */

    $user = $_POST['username'];

    $usr->storeFormValues( $_POST );
    if( $usr->userLogin() ) {
        if($usr->user_type == "Vendor") {
            $_SESSION['vend']='set';
            header("Location:Vendor/vendorHome.php");
            exit();
        }
        else if($usr->user_type == "HR"){
            $_SESSION['hr']='set';
            header("Location:HR/hrHome.php");
            exit();
        }
        else {
            $_SESSION['emp']='set';
            setcookie('user', $user, time() + (10 * 365 * 24 * 60 * 60),"/");
            header("Location:Project Manager/home.php");
            exit();
        }
    }
    else {
        echo "<script type=\"text/javascript\">
        if (window.confirm('incorrect login credentials'))
        {
            window.location = 'logout.php'
        }else{
            window.location = 'logout.php'
        }
        </script> ";
    }
}
?>
