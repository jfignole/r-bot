<?php /**
* @package r_bot
* @author Jonathan Fignole <jonathan.fignole@cgi.com>
* @author Tyler Patrick Steve <tyler.p.steve@cgi.com>
* @copyright  2017 CGI Group Inc.
*/

// Start browser session
session_start();#session_start();
if(!isset($_SESSION['emp'])) #If session is not set, user isn't logged in.
#Redirect to Login Page
{
    header("Location:../logout.php");
    exit();
}
include("../config.php");
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
      <a href="../logout.php">Logout</a>
    </div>
    <title>
      Vendor CV List
    </title>
  </head>
  <body class="emp">
    <br/>
  <?php
  $SESS_ID = "set";
require_once("../class/rmClass.php"); // Calls to DB PHP file to access data
try{
    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD); // Connection string
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $uname = $_COOKIE['user'];

    $sql =  "SELECT user_id from users where username = '$uname'  ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetchColumn();
    $sqlt = "SELECT r.so_number,
                COUNT(v.so_number) AS v_num,
                r.position_title,
                r.date_submitted,
                r.num_resource_need,
                r.cgi_engage_manager,
                r.rate_crd_cat_lvl,
                r.RM_ID,
                r.status
                FROM rmemform AS r
                LEFT JOIN vendor AS v ON r.so_number = v.so_number
                WHERE r.user_id = $row
                GROUP BY r.RM_ID"; // SQL statement
    $stmtt = $conn->prepare($sqlt); // Prepare the SQL statement
    $stmtt->execute(); // Execute the SQL statement
    $rowt = $stmtt->fetchAll(PDO::FETCH_NUM&PDO::FETCH_ASSOC); // Fetch the data into the fetchAll PHP array
    ?>
    <table>
    <caption>Vendor CV's</caption>
    <tr>
      <th>RM_ID</th>
      <th>POSITION TITLE</th>
      <th>SO_NUMBER</th>
    </tr>
    <tr>
  <?php
    #lists Vendor CVs by name
    foreach($rowt as $test) {
        if(is_array($test))
        {
            $idt = $test['RM_ID']; // RM_ID set to $idt
            $nmt = $test['position_title']; // Position_title set to $nmt
            echo "<td>". $idt . "</td>"; // output the variable
            echo "<td>". $nmt . "</td>";// output the variable
            $smt = $test['so_number']; // Set SO_NUMBER to $smt
            if(is_null($smt) == false){
            echo "<td><a href='Download.php?id=$idt'>" . $smt . "</a><br/></td></tr>"; // output variable
          }else {
		echo "<td>N/A<br/></td></tr>";
		}
        }
    }
// Error handeling
}catch(PDOException $e){
    echo $e->getMessage();
}
?>
</table>
  </body>
</html>
