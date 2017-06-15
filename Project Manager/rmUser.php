<?php /**
* @package r_bot
* @author Jonathan Fignole <jonathan.fignole@cgi.com>
* @author Tyler Patrick Steve <tyler.p.steve@cgi.com>
* @copyright  2017 CGI Group Inc.
*/
session_start();
if(!isset($_SESSION['emp'])){#If session is not set, user isn't logged in.
                             #Redirect to Login Page
      header("Location:../logout.php");
      exit();
   }
include("../config.php");
 if( !(isset( $_POST['submit'] ) ) ) { ?>
<!DOCTYPE html>
<html>
 <header>
    <!-- Banner image for every page -->
    <center>
      <img src="/images/banner2.png" alt="Banner">
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
    <table align="center">
      <form method='POST'>
        <tr>
          <th>USERNAME</th>
        </tr>
        <tr>
          <td><input type="text" name="username"></td>
        </tr>
        <tr>
          <td colspan="3"><button type="submit" name="submit" value="Submit" >Remove User</button>
            <input type="reset" value="Reset" name="reset" class="res">
          </td>
        </form>
        </tr>
      </table>
    	</body>
    </html>
    <?php
    } else {
      try {
        $id = $_POST['username'];
        $test = $_COOKIE['user'];
        $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if(isset($_POST['submit'])) {
          if($id == $test){
            echo  " <script type=\"text/javascript\">
          if (window.confirm('User Currently Logged In. Cannot Be Removed'))
          {
              window.location = 'rmUser.php';
          }
          </script> ";
          } else {

          $sqlc = "SELECT * FROM users WHERE username = '$id'";
          $stmc = $con->prepare($sqlc);
          $stmc->execute();
          $rowc = $stmc->fetchAll();
          if($rowc == null)
          {
            echo " <script type=\"text/javascript\">
          if (window.confirm('User Does Not Exist'))
          {
              window.location = 'rmUser.php';
          }
          </script> ";
        }else {
          $sql = "DELETE FROM users WHERE username = '$id'";
          $stmt = $con->prepare($sql);
          $stmt->execute();
          $sqlt = "ALTER TABLE users auto_increment = 1";
          echo " <script type=\"text/javascript\">
        if (window.confirm('User Removed'))
        {
            window.location = 'home.php';
        }
        </script> ";
        $stmtn = $con->prepare($sqlt);
        $stmtn->execute();
      }
        }
      }
    }catch(PDOException $e) {
      $correct = false;
      return $e->getMessage();
    }}
  ?>
