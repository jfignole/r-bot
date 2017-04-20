<?php /**
* @package r_bot
* @author Jonathan Fignole <jonathan.fignole@cgi.com>
* @copyright  2017 CGI Group Inc.
*/ session_start();
if(!isset($_SESSION['hr']))#If session is not set, user isn't logged in.
                            #Redirect to Login Page
       {
           header("Location:../logout.php");
           exit();
       } ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Home</title>
<link rel="stylesheet" href="../styles.css" type="text/css" />
</head>
<ul>
<li><a>R-BOT</a></li>
<li><a href="pend_RM_Forms.php" style ="font-size:14px">Pending RM Form</a></li>
<li><a href="../logout.php" style="font-size:14px">Logout</a></li>
</ul>
<h1>CGI</h1>
<h2>R-Bot</h2>
<body class="hnr">
Welcome to the HR Page!
<?php
require_once("../class/rmClass.php");
$date = array(array());
$date = rmClass::hrFillForm($date);
#lists RM Forms available by date filled out?>
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
  <tr><?php foreach($date as $test) {
    if(is_array($test))
    {
      $pt = $test['position_title'];
      $dt = $test['date_submitted'];
      $nr = $test['num_resource_need'];
      $mng = $test['cgi_engage_manager'];
      $rcc = $test['rate_crd_cat_lvl'];
      $id = $test['RM_ID'];
      $st = $test['status'];
    echo "<td><a href='HR_RM_Form.php?id=$id'>" . $pt . "</a></td><td>" . date("Y-m-d", strtotime($dt)) . "</td><td>" . $nr . "</td><td>" . $mng . "</td><td>" . $rcc . "</td><td>" . $st . "</td></tr>";
    }
  }?>
</body>
</html>
