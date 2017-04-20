<?php /**
* @package r_bot
* @author Jonathan Fignole <jonathan.fignole@cgi.com>
* @copyright  2017 CGI Group Inc.
*/
session_start();#session_start();
if(!isset($_SESSION['emp'])) #If session is not set, user isn't logged in.
                             #Redirect to Login Page
       {
           header("Location:../logout.php");
           exit();
       }
include("../config.php");
$id = $_GET['id'];
 $i = 0;
 ?>
 <!DOCTYPE html>
 <html>
   <head>
     <link rel='stylesheet' href='../styles.css' type='text/css'>
     <ul> <!--Menu-->
     <li><a>R-BOT</a></li>
     <li><a href='home.php' style = "font-size:14px">Home</a></li>
     <li><a href="RM_Form.php" style ="font-size:14px">New RM_Form</a></li>
     <li><a href="hrAppList.php" style = "font-size:14px">HR Approved List</a></li>
     <li><a href="vendorCVList.php" style = "font-size:14px">Vendor CVs</a></li>
     <li><a href="../logout.php" style="font-size:14px">Logout</a></li>
     </ul>
     <title>Uploaded CVs</title>
   </head>
   <body class="emp">
     <h1>CGI</h1>
     <h2>R-Bot</h2>
     <table>
       <tr>
         <th class='EMP'><?php echo "CV Files for $id"?></th>
       </tr>
     <?php
     try{
     $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $sqlt = "SELECT * FROM files WHERE so_number = '$id'";
     $stmtt = $conn->prepare($sqlt);
     $stmtt->execute();
     $rowt = $stmtt->fetchAll(PDO::FETCH_NUM&PDO::FETCH_ASSOC);
     #lists Vendor CVs by name
     foreach($rowt as $test) {
     	if(is_array($test))
     	{
         $ids = $test['so_number'];
         $name = $test['fileName'];
         echo "<tr><td><a href='../uploads/"  . $name . "' target='_blank'>". $name . "</a></td></tr>";
         }
         }
         }catch(PDOException $e){
         echo $e->getMessage();
         }
?>
</table>
</body>
</html>
