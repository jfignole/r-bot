<?php /**
* @package r_bot
* @author Jonathan Fignole <jonathan.fignole@cgi.com>
* @author Tyler Patrick Steve <tyler.p.steve@cgi.com>
* @copyright  2017 CGI Group Inc.
*/ session_start();
if(!isset($_SESSION['hr']))#If session is not set, user isn't logged in.
#Redirect to Login Page
{
    header("Location:../logout.php");
    exit();
} ?>
<!-- Begin HTML -->
  <!DOCTYPE html>
  <html>
  <header>
    <center><img src="/images/banner_main.png" alt="Banner">
      <center>
  </header>
  <head>
    <meta charset="utf-8">
    <title>HR_Home</title>
    <link rel="stylesheet" href="../styles.css" type="text/css" />
  </head>
  <div class="container">
    <a href="../logout.php">Logout</a>
  </div>
  <body class="hnr">
    <?php echo "<h3><u>Welcome to the HR Portal</u></h3>";
      require_once("../class/rmClass.php");
      $date = array(array());
      $date = rmClass::hrFillForm($date);
      // lists RM Forms available by date filled out
    ?>
      <table>
        <caption>CURRENT RM_FORM STATUS</caption>
        <tr>
          <th>POSITION TITLE</th>
          <th>DATE</th>
          <th># OF RESOURCES NEEDED</th>
          <th>CGI ENGAGEMENT MANAGER</th>
          <th>RATE CARD-CATEGORY-LEVEL</th>
          <th>STATUS</th>
        </tr>
        <tr>
    <?php foreach($date as $test) {
      if(is_array($test))
      {
          $pt = $test['position_title']; // position_title set as $pt
          $dt = $test['date_submitted']; // date_submitted set as $dt
          $nr = $test['num_resource_need']; // num_resource_need set as $nr
          $mng = $test['cgi_engage_manager']; // cgi_engage_manager set as $mng
          $rcc = $test['rate_crd_cat_lvl']; // rate_crd_cat_lvl set as $rcc
          $id = $test['RM_ID']; // RM_ID set as $id
          $st = $test['status']; // status set as $st
          // Output all current RM_FORM's that need SO_NUMBER assignment
          echo "<td><a href='HR_RM_Form.php?id=$id'>" . $pt . "</a></td><td>" . date("Y-m-d", strtotime($dt)) . "</td><td>" . $nr . "</td><td>" . $mng . "</td><td>" . $rcc . "</td><td>" . $st . "</td></tr>";
      }
}?>
  </table>
    <?php
    try{
        /*$conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD); // set DB username and password
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sqlt = "SELECT * FROM rmemform WHERE status = 'WAITING FOR VENDOR RESPONSE' or status = 'REJECTED'"; // SQL statement
        $stmtt = $conn->prepare($sqlt); // prepare SQL
        $stmtt->execute(); // execute SQL*/
        $rowt = array(array());
        $rowt = rmClass::hrPastFillForm($rowt); // uses PHP fetchALL to gather data
    // error handling
    }catch (PDOException $et) {
        echo $et->getMessage();
    }
    // lists RM Forms available by date filled out?>
          <table>
            <caption>RM_FORM STATUS HISTORY</caption>
            <tr>
              <th>POSITION TITLE</th>
              <th>DATE</th>
              <th># OF RESOURCES NEEDED</th>
              <th>CGI ENGAGEMENT MANAGER</th>
              <th>RATE CARD-CATEGORY-LEVEL</th>
              <th>STATUS</th>
            </tr>
            <tr>
        <?php foreach($rowt as $testPast) {
          if(is_array($testPast))
          {
              $pt = $testPast['position_title']; // position_title set as $pt
              $dt = $testPast['date_submitted']; // date_submitted set as $dt
              $nr = $testPast['num_resource_need']; // num_resource_need set as $nr
              $mng = $testPast['cgi_engage_manager']; // cgi_engage_manager set as $mng
              $rcc = $testPast['rate_crd_cat_lvl']; // rate_crd_cat_lvl set as $rcc
              $id = $testPast['RM_ID']; // RM_ID set as $id
              $st = $testPast['status']; // status set as $st
              // Output all previous assigned SO_NUMBER's / RM_FORM's
              echo "<td><a href='HR_RM_Form.php?id=$id'>" . $pt . "</a></td><td>" . date("Y-m-d", strtotime($dt)) . "</td><td>" . $nr . "</td><td>" . $mng . "</td><td>" . $rcc . "</td><td>" . $st . "</td></tr>";
          }
      }?>
      </table>
    </body>
  </html>
