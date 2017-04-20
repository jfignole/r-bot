<?php /**
* @package r_bot
* @author Jonathan Fignole <jonathan.fignole@cgi.com>
* @copyright  2017 CGI Group Inc.
*/
session_start();
if(!isset($_SESSION['emp'])){#If session is not set, user isn't logged in.
                             #Redirect to Login Page
      header("Location:../logout.php");
      exit();
   }
include("../config.php");
$id = $_GET['id'];#Gets id from previous page and queries the database to get
                   #information to fill in this particular RM_FORM
$conn=new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD); #DB Connection
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);#Sets PDO error types
$sql = "SELECT * FROM rmemform WHERE RM_ID = '$id'";
$stmt = $conn->prepare($sql);
$stmt->execute();#Builds and runs query
$rowt = $stmt->fetchAll(PDO::FETCH_ASSOC);#Fetches query into array with column
                                          #names instead of indexes
 if( !(isset( $_POST['submit'] ) ) ) { ?>
<!DOCTYPE html>
<html>
<head>
	<link rel='stylesheet' href='../styles.css' type='text/css'>
  <ul> <!--Menu-->
  <li><a>R-BOT</a></li>
  <li><a href='home.php' style = "font-size:14px">Home</a></li>
  <li><a href="RM_Form.php" style ="font-size:14px">New RM_Form</a></li>
  <li><a href="hrAppList.php" style = "font-size:14px">HR Approved List</a></li>
  <li><a href="vendorCVList.php" style = "font-size:14px">Vendor CVs</a></li>
  <li><a href="vendorCVUpload.php" style = "font-size:14px">Uploaded Vendor CVs</a></li>
  <li><a href="../logout.php" style="font-size:14px">Logout</a></li>
  </ul>
	<title>
	GPO RM Form IIB Onshore
	</title>
</head>
	<body class="emp">
		<h1>CGI</h1>
    <h2>R-Bot</h2>
    <table>
      <form method='POST'>
        <tr>
          <th>SO_NUMBER</th>
          <th>POSITION TITLE</th>
          <th>STATUS</th>
        </tr>
        <tr>
          <td><output type="text" name="so_number"><?php echo $rowt[0]['so_number']?></output></td>
          <td><output type="text" name="ptitle"><?php echo $rowt[0]['position_title']?></output></td>
          <td><select name="status">
                  <option value="RM_FORM CLOSED" <?php if($rowt[0]['status'] == "RM_FORM CLOSED") echo "selected='selected'";?>>RM_FORM CLOSED</option>
                  <option value="REMOVE RM_FORM" <?php if($rowt[0]['status'] == "REMOVE RM_FORM") echo "selected='selected'";?>>REMOVE RM_FORM</option>
              </select></td>
        </tr>
        <tr>
          <td colspan="3"><button type="submit" name="submit" value="Submit" >Submit</button>
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
        $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if($_POST['status'] == 'REMOVE RM_FORM') {
          $sql = "DELETE FROM rmemform WHERE RM_ID = '$id'";
          $stmt = $con->prepare($sql);
          $stmt->execute();
          echo "Form Removed Successfully <br/> <a href='home.php'>Home</a>";
        } else {
        $sql = "UPDATE rmemform SET status = :status WHERE RM_ID = '$id'";
      $stmt = $con->prepare($sql);
      $stmt->execute(array(
        ':status' => $_POST['status']
      ));
      echo "Form Updated Successfully <br/> <a href='home.php'>Home</a>";
    }}catch(PDOException $e) {
      $correct = false;
      return $e->getMessage();
    }
  }
  ?>
