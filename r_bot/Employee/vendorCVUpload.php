<?php
session_start();#session_start();
if(!isset($_SESSION['emp'])) #If session is not set, user isn't logged in.
                             #Redirect to Login Page
       {
           header("Location:../logout.php");
           exit();
       }
include("../config.php");
try{
$conn=new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD); #DB Connection
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);#sets PDO error types
}catch(PDOException $e){
 echo $e->getMessage();
 }

 $stmt= $conn->prepare('SELECT * FROM files');
 $stmt->execute();
 $rowt = $stmt->fetchAll(PDO::FETCH_NUM&PDO::FETCH_ASSOC);
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
   <body>
     <h1>CGI</h1>
     <h2>R-Bot</h2>
     <table>
       <tr>
         <th class='EMP'>File Name</th>
       </tr>
     <?php
 foreach($rowt as $test) {
   if(is_array($test))
   {
?>
    <tr>
      <td><a href='../uploads/<?php echo $rowt[$i]['fileName']; ?>'
        target="_blank"><?php echo $rowt[$i]['fileName']; ?></a></td>
    </tr>
  <?php
$i = $i + 1;
}
}
?>
</table>
</body>
</html>
