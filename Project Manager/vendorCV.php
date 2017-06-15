<?php /**
* @package r_bot
* @author Jonathan Fignole <jonathan.fignole@cgi.com>
* @author Tyler Patrick Steve <tyler.p.steve@cgi.com>
* @copyright  2017 CGI Group Inc.
*/
session_start();
if(!isset($_SESSION['emp'])) // If session is not set, user isn't logged in.
// Redirect to Login Page
{
    header("Location:../logout.php");
    exit();
}
// DB -> PHP config file
include("../config.php");
$id = $_GET['id'];// gets id from previous page and queries the database to get
// information to fill in this particular RM_FORM
$conn=new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);// DB Connection
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);// sets PDO error types
$sql = "SELECT * FROM vendor WHERE v_id = '$id'"; // SQL statement
$sql2 = "SELECT so_number, id, fileName FROM files WHERE id='$id'"; // SQL statement // 2
$stmt = $conn->prepare($sql); // prepare first SQL
$stmt2 = $conn->prepare($sql2); // prepare second SQL
$stmt->execute();// builds and runs query
$stmt2->execute(); // execute second SQL
$rowt = $stmt->fetchAll(PDO::FETCH_ASSOC);// fetches query into array with column
$rowt2 = $stmt2->fetchALL(PDO::FETCH_ASSOC);// fetches query into array with column names instead of indexes
// names instead of indexes
try {
    $id2 = $rowt[0]['so_number']; // grabs raw array value for SO_NUMBER
    $con=new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);// DB Connection
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);// sets PDO error types
    $sqlt = "SELECT * FROM rmemform WHERE so_number = '$id2'";
    $stmtn = $con->prepare($sqlt);
    $stmtn->execute();// builds and runs query
    $rown = $stmtn->fetchAll(PDO::FETCH_ASSOC);// fetches query into array with column names instead of indexes
// error handling
}catch(PDOException $e) {
    $correct = false;
    echo $e->getMessage();
}
?>
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
      <!--<a href="vendorCVList.php" onclick="goBack()">Go Back</a>-->
      <a href="../logout.php">Logout</a>
    </div>
    <!-- JS to go back one page in session -->
    <script>
      function goBack() {
        javascript:history.go(-1);
        return false;
      }
      </script>
    <title>Vendor CV</title>
  </head>
  <body class="emp">
    <h3>Application for <?php echo $rowt[0]['so_number'] .": ". $rowt[0]['name']?></h3>
    <table>
      <tr>
        <th class='VEND'><b>Name</b></th>
        <th class='VEND'><b>Phone Number</b></th>
        <th class='VEND'><b>Best Time to Call<b></th>
</tr>
<tr><td><output type='text' maxlength="30" required name='name'><?php echo $rowt[0]['name']?></output></td>
<td><output type="text" maxlenth="30" required  name="p_num"><?php echo $rowt[0]['phone_number']?></output></td>
<td><output type='text' maxlength="30" required name='bc_time'><?php echo $rowt[0]['best_call_time']?></output></td></tr>
<tr>
<th class='VEND'><b>Visa Status<b></th>
<th class='VEND'><b>IT Experience<b></th>
<th class='VEND'><b>Relevant Experience<b></th>
</tr>
<tr><td><output type='text' maxlength="30" required name='v_status'><?php echo $rowt[0]['visa_status']?></output></td>
<td><output type='text' maxlength="30" required name='it_exp'><?php echo $rowt[0]['it_exp']?></output></td>
<td><output type='text' maxlength="30" required name='rel_exp'><?php echo $rowt[0]['relevant_exp']?></output></td>
</tr>
<tr>
<th class='VEND' colspan="3"><b>Description<b></th>
</tr>
<tr>
<td colspan="3"><output name="description" rows="4" cols="100"></output><?php echo wordwrap($rowt[0]['description'], 100, "<br />\n");?></td>
</tr>
<tr>
  <th class='VEND' colspan="2"><b>Status</b></th>
  <td colspan="3"><output name="status" rows="4" cols="100"></output><?php echo wordwrap($rown[0]['status'], 100, "<br />\n");?></td>
      </tr>
      
</tr>
<tr>
<td colspan="3"><output name="description" rows="4" cols="100"></output><?php echo wordwrap($rown[0]['rej_reason'], 100, "<br />\n");?></td>
</tr>
<!-- Check fo submit -->
<?php if(!(isset($_POST['submit']))) {?>
    <form method="POST" action="" >
    <tr>
    <th class='VEND' colspan="3"><b>Feedback<b></th>
      </tr>
      <tr>
        <td colspan="3">
          <textarea name="feedback" rows="4" cols="60" value="feedback" placeholder="Feedback" class="input"></textarea>
        </td>
      </tr>
      <tr>
        <td colspan="3">
          <button type="submit" name="submit" value="Submit">Submit Feedback</button>
          <button href="// " onclick="window.open('/uploads/<?php echo $rowt2[0]['fileName']?>', '_blank', 'fullscreen=yes'); return false;">View CV</button>
        </td>
      </tr>
      </form>
      </tr>
    </table>
  </body>
  </html>
  <?php
  } else{
        try {
            $name = $rowt[0]['name']; // grabs raw array value for name
	    $so = $rowt[0]['so_number'];
            $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD); // sets username and password for DB
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE vendor SET feedback = :feedback WHERE name = '$name' AND so_number = '$so'"; // SQL statement
            $stmt = $con->prepare($sql); // prepare the SQL statement
            $stmt->execute(array( // execute the SQL statement
            ':feedback' => $_POST['feedback']
            ));
            $id = $rown[0]['RM_ID'];
           // JS alert to redirect
           echo "<script type=\"text/javascript\">
                      if (window.confirm('Feedback added'))
                      {
                          window.location = 'home.php'
                      }else{
                          window.location = 'home.php'
                      }
                      </script> ";
        // error handling
        }catch(PDOException $e) {
            $correct = false;
            // Force logout on error
            echo $e->getMessage()."<br/> <a href='hrHome.php'>Home</a> <a href='../logout.php'>Logout</a>";
        }
    }
    ?>