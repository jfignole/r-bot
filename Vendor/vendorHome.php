<?php /**
* @package r_bot
* @author Jonathan Fignole <jonathan.fignole@cgi.com>
* @author Tyler Patrick Steve <tyler.p.steve@cgi.com>
* @copyright  2017 CGI Group Inc.
*/
session_start(); // begin browser session
if(!isset($_SESSION['vend'])) // If session is not set, user isn't logged in.
// Redirect to Login Page
{
    header("Location:../logout.php");
    exit();
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
    <link rel="icon" href="/images/CGI_Logo_color.png">
    <meta charset="utf-8">
    <title>Home</title>
    <link rel="stylesheet" href="../styles.css" type="text/css" />
  </head>
  <div class="container">
    <a href="feedbackList.php">Feedback</a>
    <a href="../logout.php">Logout</a>
  </div>
  <body class="vndr">
    <?php echo "<h3><u>Welcome to the Vendor Portal</u></h3>";
      require_once("../class/rmClass.php"); // requires DB SQL script
      $date = array(array()); // creates empty array to be filled with data
      $date = rmClass::vendFillForm($date); // calls the specific script on rmClass.php
    ?>
      <table>
        <caption>CURRENT RM_FORM STATUS</caption>
        <tr>
          <th>SO_NUMBER/ POSITION TITLE</th>
          <th>DATE</th>
          <th># OF RESOURCES NEEDED</th>
        </tr>
        <tr>
<?php foreach($date as $test) {
    if(is_array($test))
    {
        $pt = $test['position_title']; // position_title set as $pt
        $dt = $test['date_submitted']; // date_submitted set as $dt
        $nr = $test['num_resource_need']; // num_resource_need set as $nr
        $id = $test['RM_ID']; // RM_ID set as $id
        $so = $test['so_number']; // so_number set as $so
        // output for $so to each vendorForm attached to that $id
        echo "<td><a href='vendorForm.php?id=$id'>" . $so . ": " . $pt . "</a></td><td>" . date("Y-m-d", strtotime($dt)) . "</td><td>" . $nr . "</td></tr>";
    }
}?>
    </body>
  </html>