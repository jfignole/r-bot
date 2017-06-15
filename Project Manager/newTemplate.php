<?php /**
* @package r_bot
* @author Jonathan Fignole <jonathan.fignole@cgi.com>
* @author Tyler Patrick Steve <tyler.p.steve@cgi.com>
* @copyright  2017 CGI Group Inc.
*/
session_start();
if(!isset($_SESSION['emp'])) #If session is not set, user isn't logged in.
#Redirect to Login Page
{
    header("Location:../logout.php");
    exit();
}
include("../config.php");
if(!(isset( $_POST['submit']))) { ?>
<!-- Begin HTML -->
  <!DOCTYPE html>
  <html>
  <header>
    <center><img src="/images/banner_main.png" alt="Banner">
      <center>
  </header>
  <head>
    <link rel='stylesheet' href='../styles.css' type='text/css'>
    <div class="container">
      <a href="home.php">Home</a>
      <a href="../logout.php">Logout</a>
    </div>
    <title>
      GPO RM Form IIB Onshore
    </title>
  </head>
  <body class="emp">
    <table>
      <form method='POST' action=''>
        <tr>
          <th><b>POSITION TITLE</b></th>
          <td>
            <input type="text" placeholder="Position Title" name="ptitle">
          </td>
        </tr>
        <tr>
          <th><b>POSITION DESCRIPTION</b></th>
          <td colspan="2">
            <textarea name="posit_desc" rows="8" cols="60" placeholder="Requirements and Responsibilities" class="input"></textarea>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <button type="submit" name="submit" value="Submit" >Save Template</button>
            <input type="reset" value="Reset" name="reset" class="res">
          </td>
      </form>
      </tr>
    </table>
  </body>
  </html>
  <?php
    // Error handling
    }else {
      $title = $_POST['ptitle'];
      if($title == null || $_POST['posit_desc'] == null)
      {
        echo "<script type=\"text/javascript\">
    window.alert('Position Title and Position Description must be filled in.')
    window.location = 'newTemplate.php'
    </script> ";
  } if(strlen($title) >= 21)
  {
    echo "<script type=\"text/javascript\">
window.alert('Position Title is too long.')
window.location = 'newTemplate.php'
</script> ";
  }
      $form = new template;
      $form->storeFormValues($_POST);
      echo $form->insertForm($_POST);#stores new Template in the database
    }
  ?>
