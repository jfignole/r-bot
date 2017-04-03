<?php
session_start();
if(!isset($_SESSION['emp'])) #If session is not set, user isn't logged in.
                             #Redirect to Login Page
       {
           header("Location:../logout.php");
           exit();
       }
       include("../config.php");
       $id = $_GET['id'];#gets id from previous page and queries the database to get
                          #information to fill in this particular RM_FORM
       $conn=new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);#DB Connection
       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);#sets PDO error types
       $sql = "SELECT * FROM vendor WHERE V_ID = '$id'";
       $stmt = $conn->prepare($sql);
       $stmt->execute();#builds and runs query
       $rowt = $stmt->fetchAll(PDO::FETCH_ASSOC);#fetches query into array with column
                                                 #names instead of indexes
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
      <li><a href="vendorCVUpload.php" style = "font-size:14px">Uploaded Vendor CVs</a></li>
      <li><a href='vendorCVList.php' style = "font-size:14px">Back</a></li>
      <li><a href="../logout.php" style="font-size:14px">Logout</a></li>
      </ul>
      <title>Vendor CV</title>
   </head>
   <body>
     <h1>CGI</h1>
     <h2>R-Bot</h2>
      <h3>Application for <?php echo $rowt[0]['so_number'] .": ". $rowt[0]['name']?></h3>
       <table>
             <tr><th class='VEND'><b>Name</b></th>
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
         <?php if(!(isset($_POST['submit']))) {?>
           <form method="POST" action="" >
         <tr>
           <th class='VEND' colspan="3"><b>Feedback<b></th>
         </tr>
        <tr>
          <td colspan="3"><textarea name="feedback" rows="4" cols="100" value="feedback">Feedback</textarea></td>
        </tr>
        <tr>
          <td colspan="2"><button type="submit" name="submit" value="Submit">Submit Feedback</button></td>
        </td>
      </form>
    </tr>
  </table>
  </body>
</html>
<?php
} else{
  try{
    $name = $rowt[0]['name'];
    $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE vendor SET feedback = :feedback WHERE name = '$name'";
    $stmt = $con->prepare($sql);
    $stmt->execute(array(
      ':feedback' =>$_POST['feedback']
    ));
      $correct = true;
    echo "Feedback Added Successfully <br/> <a href='home.php'>Home</a> <br/> <a href='../email.php'>E-mail</a>";
  }catch(PDOException $e) {
    $correct = false;
    echo $e->getMessage()."<br/> <a href='hrHome.php'>Home</a> <a href='../logout.php'>Logout</a>";
  }
}

?>
