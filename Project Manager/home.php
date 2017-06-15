<?php /**
* @package r_bot
* Project Manager Homepage.
*
* Allows navigation to other pages that fall under Project Manager umbrella.
*
* @author Jonathan Fignole <jonathan.fignole@cgi.com>
* @author Tyler Patrick Steve <tyler.p.steve@cgi.com> 
* @copyright  2017 CGI Group Inc.
*/
# Session begin command
session_start();
if(!isset($_SESSION['emp'])) #If session is not set, user isn't logged in.
#Redirect to Login Page
{
    header("Location:../logout.php");
    exit();
}
//include_once("../header.php");
?>
  <!DOCTYPE html>
  <html>
  <div id="header">
    <!-- Banner image for every page -->
    <img src="/images/banner_main.png" alt="Banner">
  </div>
  <head>
    <meta charset="utf-8">
    <center><title>Project Manager Hub</title></center>
    <link rel="stylesheet" href="../styles.css" type="text/css" />
    <div class="container">
      <div class="dropdown">
        <!-- Menu options -->
        <button class="dropbtn" id="1">New RM_Form</button>
        <div class="dropdown-content">
          <a href="RM_Form.php">Create New</a>
          <a href="RM_Form_Template.php">Create From Template</a>
        </div>
      </div>
    <div class="container">
      <div class="dropdown">
        <!-- Menu options -->
        <button class="dropbtn" id="2">User Management</button>
        <div class="dropdown-content">
          <a href="../register.php">Register New User</a>
          <a href="rmUser.php">Remove User</a>
        </div>
      </div>
      <!-- Menu options -->
      <a href="newTemplate.php">New Template</a>
      <a href="downloadFormList.php">Download Form</a>
      <a href="help.php">Help</a>
      <a href="../logout.php">Logout</a>
	</div>
    </div>
  </head>
  <body class="emp">
    <?php 
      echo "<h3><u>Welcome to the Project Manager Portal</u></h3>";
      # Open session to DB
      $SESS_ID = "set";
      require_once("../class/rmClass.php");
      $date = array(array());
      # Call to DB query in PHP PDO
      $date = rmClass::filltable($date);
      # lists RM Forms available by date filled out
    ?>
    <?php
      require_once("../class/vendors.php");
      # Create emprty array set
      $rowt = array(array());
      # Call to DB query in PHP PDO
      $rowt = vendors::soCount($rowt);
      # lists Vendor CVs by name
      try{
          $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sqlt = "SELECT so_number, count(*) FROM files GROUP BY so_number ORDER BY so_number"; // SQL statement
          $stmtt = $conn->prepare($sqlt); // Prepare SQL
          $stmtt->execute(); // Execute SQL
          $row = $stmtt->fetchAll(PDO::FETCH_NUM&PDO::FETCH_ASSOC);
      // Error handeling
      }catch (PDOException $et) {
          echo $et->getMessage();
      }
?>
<!-- Begin HTML -->
<!-- Create table for data output -->
  <table>
    <caption>Current RM_FORM'S</caption>
    <tr>
      <th>SO_NUMBER</th>
      <th># OF APPLICANTS</th>
      <th>POSITION TITLE</th>
      <th width="7%">DATE</th>
      <th># OF RESOURCES NEEDED</th>
      <th>CGI ENGAGEMENT MANAGER</th>
      <th>RATE CARD-CATEGORY-LEVEL</th>
      <th>STATUS</th>
      <th>UPDATE STATUS</th>
    </tr>
    <tr>
<?php
  # Begin data output from PHP calls
  $i=0;
  foreach($date as $test) # Itterate through the data/ array
  {
      $so = $date[$i]['so_number']; # Calls the specific value in the date array
      echo "<td><a href='vendorCVList.php?id=$so'>". $so ."</a></td>"; # Makes SO_NUMBER redirect to that form
      $pt = $test['position_title']; // position_title set to $pt
      $dt = $test['date_submitted']; // date_submitted set to $dt
      $nr = $test['num_resource_need']; // num_resource_need set to $nr
      $mng = $test['cgi_engage_manager']; // cgi_engage_manager set to $mng
      $na = $date[$i]['v_num']; // v_num set to $na
      echo "<td>".$na."</td>"; // output of the variable
      $rcc = $test['rate_crd_cat_lvl']; // rate_crd_cat_lvl set to $rcc
      $id = $test['RM_ID']; // RM_ID set to $id
      $st = $test['status']; // status set to $st
      # Makes position_title and close access a clickable link
      echo "<td><a href='HR_AP_RM_Form.php?id=$id'>" . $pt . "</a></td><td>"
      . date("Y-m-d", strtotime($dt)) . "</td><td>" . $nr . "</td><td>" . $mng
      . "</td><td>" . $rcc . "</td><td>" . $st . "</td><td><a href='close.php?id=$id'>Update</a></td></tr>";
      $i++;
  }
?>
</table>
  </body>
</html>