<?php /**
* @package r_bot
* @author Jonathan Fignole <jonathan.fignole@cgi.com>
* @copyright  2017 CGI Group Inc.
*/
session_start();
if(!isset($_SESSION['vend'])) #If session is not set, user isn't logged in.
                             #Redirect to Login Page
       {
           header("Location:../logout.php");
           exit();
       }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Home</title>
<link rel="stylesheet" href="../styles.css" type="text/css" />
</head>
<ul>
<li><a>R-BOT</a></li>
<li><a href="rm_request_list.php" style ="font-size:14px">RM_Form List</a></li>
<li><a href="feedbackList.php" style="font-size:14px">Feedback</a></li>
<li><a href="../logout.php" style="font-size:14px">Logout</a></li>
</ul>
<h1>CGI</h1>
<h2>R-Bot</h2>
<body class="vndr">
<?php echo "Welcome to the Vendor Page!";
require_once("../class/rmClass.php");
$date = array(array());
$date = rmClass::vendFillForm($date);
#lists RM Forms available by date filled out?>
<table>
    <caption>CURRENT RM_FORM STATUS</caption>
  <tr>
    <th>POSITION TITLE</th>
    <th>DATE</th>
    <th># OF RESOURCES NEEDED</th>
  </tr>
  <tr><?php foreach($date as $test) {
    if(is_array($test))
    {
      $pt = $test['position_title'];
      $dt = $test['date_submitted'];
      $nr = $test['num_resource_need'];
      $id = $test['RM_ID'];
      $so = $test['so_number'];
    echo "<td><a href='vendorForm.php?id=$id'>" . $so . ": " . $pt . "</a></td><td>" . date("Y-m-d", strtotime($dt)) . "</td><td>" . $nr . "</td></tr>";
    }
  }?>
</body>
</html>
