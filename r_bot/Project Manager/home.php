<?php /**
* @package r_bot
* Project Manager Homepage.
*
* Allows navigation to other pages that fall under Project Manager umbrella.
*
* @author Jonathan Fignole <jonathan.fignole@cgi.com>
* @copyright  2017 CGI Group Inc.
*/
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
<head>
<meta charset="utf-8">
<title>Home</title>
<link rel="stylesheet" href="../styles.css" type="text/css" />
<ul> <!--Menu-->
<li><a>R-BOT</a></li>
<li><a href="RM_Form.php" style ="font-size:14px">New RM_Form</a></li>
<li><a href="hrAppList.php" style = "font-size:14px">HR Approved List</a></li>
<li><a href="vendorCVList.php" style = "font-size:14px">Vendor CVs</a></li>
<li><a href="vendorCVUpload.php" style = "font-size:14px">Uploaded Vendor CVs</a></li>
<li><a href="../logout.php" style="font-size:14px">Logout</a></li>
</ul>
</head>
<h1>CGI</h1>
<h2>R-BOT</h2>
<body class="emp">
<?php echo "<b>Welcome to the Project Manager Page!</b>";
      $SESS_ID = "set";
      require_once("../class/rmClass.php");
      $date = array(array());
      $date = rmClass::fillForm($date);
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
        	echo "<td><a href='HR_AP_RM_Form.php?id=$id'>" . $pt . "</a></td><td>"
          . date("Y-m-d", strtotime($dt)) . "</td><td>" . $nr . "</td><td>" . $mng
          . "</td><td>" . $rcc . "</td><td>" . $st . "</td><td></tr>";
        	}
        }
  ?><br/>
</table>
  <?php
  require_once("../class/vendors.php");
  $rowt = array(array());
  $rowt = vendors::soCount($rowt);
  #lists Vendor CVs by name
  try{
    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sqlt = "SELECT so_number, count(*) FROM files GROUP BY so_number ORDER BY so_number";
    $stmtt = $conn->prepare($sqlt);
    $stmtt->execute();
    $row = $stmtt->fetchAll(PDO::FETCH_NUM&PDO::FETCH_ASSOC);
  }catch (PDOException $et) {
    echo $et->getMessage();
  }
  ?>
  <table>
    <caption>VENDOR APPLICATIONS</caption>
    <tr>
      <th>SO_NUMBER</th>
      <th>NUMBER OF APPLICANTS</th>
    </tr>
    <tr><?php
    foreach($rowt as $test) {
  	if(is_array($test))
  	{
      $id = $test['so_number'];
      $count = $test['count(*)'];
  	echo "<td><a href='vendorCVList.php?id=$id'>" . $id . "</a></td><td>" . $count .  "</td></tr>";
  	}
  }
  ?>
  <caption>VENDOR CVs</caption>
  <tr>
    <th>SO_NUMBER</th>
    <th>NUMBER OF CVs</th>
  </tr>
  <tr><?php foreach($row as $file) {
    if(is_array($file))
    {
      $id = $file['so_number'];
      $count = $file['count(*)'];
      echo "<td><a href = 'vendorCVUpload.php?id=$id'>" . $id . "</a></td><td>" . $count . "</td></tr>";
    }
  } ?>
<br/>
</body>
</html>
