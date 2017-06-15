<?php /**
* @package r_bot
* @author Jonathan Fignole <jonathan.fignole@cgi.com>
* @author Tyler Patrick Steve <tyler.p.steve@cgi.com> 
* @copyright  2017 CGI Group Inc.
*/
session_start();
if(!isset($_SESSION['emp'])){// If session is not set, user isn't logged in.
    // Redirect to Login Page
    header("Location:../logout.php");
    exit(); // Will exit the session on logout
}
include("../config.php");
$id = $_GET['id'];// Gets id from previous page and queries the database to get
// information to fill in this particular RM_FORM
$conn=new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD); //DB Connection
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Sets PDO error types
$sql = "SELECT * FROM rmemform WHERE RM_ID = '$id'";
$stmt = $conn->prepare($sql);
$stmt->execute();// Builds and runs query
$rowt = $stmt->fetchAll(PDO::FETCH_ASSOC);// Fetches query into array with column
// names instead of indexes
if( !(isset( $_POST['submit'] ) ) ) { ?>
<!-- Begin HTMl Table format -->
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
      <form method='POST'>
        <tr>
          <th>SO_NUMBER</th>
          <th>POSITION TITLE</th>
          <th>STATUS</th>
        </tr>
        <tr>
          <td>
            <output type="text" name="so_number">
              <?php echo $rowt[0]['so_number']?>
            </output>
          </td>
          <td>
            <output type="text" name="ptitle">
              <?php echo $rowt[0]['position_title']?>
            </output>
          </td>
          <td>
            <select name="status">
              <option value="WAITING FOR VENDOR RESPONSE" <?php if($rowt[0][ 'status']=="WAITING FOR VENDOR RESPONSE" ) echo "selected='selected'";?>>Waiting for Vendor Response</option>
              <option value="RM_FORM CLOSED/ RESOURCE HIRED" <?php if($rowt[0][ 'status']=="RM_FORM CLOSED" ) echo "selected='selected'";?>>RM_FORM Closed /Resource Hired</option>
              <!-- <option value="RM_FORM CLOSED" <//?php if($rowt[0][ 'status']=="RM_FORM CLOSED" ) echo "selected='selected'";?>>RM_FORM CLOSED</option>
              <option value="REMOVE RM_FORM" <//?php if($rowt[0][ 'status']=="REMOVE RM_FORM" ) echo "selected='selected'";?>>REMOVE RM_FORM</option> -->
            </select>
          </td>
        </tr>
        <tr>
          <td colspan="3">
            <input type="submit" name="submit" value="Submit">
            <input type="reset" value="Reset" name="reset" class="res">
          </td>
      </form>
      </tr>
    </table>
  </body>  
</html>
  <?php
  // Begin PHP loop condition for delete/ update
} else {
    try {
        $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if($_POST['status'] == 'REMOVE RM_FORM') {
            $sql = "DELETE FROM rmemform WHERE RM_ID = '$id'"; // Statement to delete a seleceted RM_FORM
            $stmt = $con->prepare($sql); // Prepare the SQL statement for execution
            $stmt->execute(); // PHP to execute the delete statement for removal of seleceted RM_FORM
            // JS to prompt and redirect to new page
            echo "<script type=\"text/javascript\">
        if (window.confirm('Form Removed'))
        {
            window.location = 'home.php'
        }else{
            window.location = 'home.php'
        }
        </script> ";
        } else {
            $sql = "UPDATE rmemform SET status = :status WHERE RM_ID = '$id'"; // Statement to update a seleceted RM_FORM
            $stmt = $con->prepare($sql); // Prepare the SQL statement for execution
            $stmt->execute(array( // PHP to execute the delete statement for removal of seleceted RM_FORM
            ':status' => $_POST['status']
            ));
            // JS to prompt and redirect to new page
            echo "<script type=\"text/javascript\">
        if (window.confirm('Form Updated'))
        {
            window.location = 'home.php'
        }else{
            window.location = 'home.php'
        }
        </script> ";
        // Error handeling
        }}catch(PDOException $e) {
            $correct = false;
            return $e->getMessage();
        }
    }
    ?>