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
  <header>
    <center><img src="/images/banner.png" alt="Banner">
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
      <tr>
        <th>SO_NUMBER</th>
        <th>POSITION TITLE</th>
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
      </tr>
      <tr>
        <th colspan="2"><b>REASON FOR REJECTION</b></th>
      </tr>
      <tr>
        <td colspan="2">
          <textarea name="rej_reason" rows="4" cols="60">
            <?php echo $rowt[0]['rej_reason']?>
          </textarea>
        </td>
      </tr>
      </form>
    </table>
  </body>

  </html>
  <?php }?>