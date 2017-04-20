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
      <link rel='stylesheet' href='../styles.css' type='text/css'>
      <ul>
      <li><a>R-BOT</a></li>
      <li><a href="vendorHome.php" style= "font-size:14px">Home</a></li>
      <li><a href="rm_request_list.php" style ="font-size:14px">RM_Form List</a></li>
      <li><a href="feedbackList.php" style="font-size:14px">Feedback</a></li>
      <li><a href="../logout.php" style="font-size:14px">Logout</a></li>
      </ul>
      <title>CV Feedback</title>
    </head>
    <body class="vndr">
     <h1>CGI</h1>
     <h2>R-Bot</h2>
      <?php
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
      <h3>Feedback for <?php echo $rowt[0]['so_number'] .": ". $rowt[0]['name']?></h3>
      <table>
            <tr><th><b>Name</b></th>
            <th><b>Phone Number</b></th>
            <th><b>Best Time to Call<b></th>
        </tr>
        <tr><td><output type='text' maxlength="30" required name='name'><?php echo $rowt[0]['name']?></output></td>
            <td><output type="text" maxlenth="30" required  name="p_num"><?php echo $rowt[0]['phone_number']?></output></td>
            <td><output type='text' maxlength="30" required name='bc_time'><?php echo $rowt[0]['best_call_time']?></output></td></tr>
        <tr>
            <th><b>Visa Status<b></th>
            <th><b>IT Experience<b></th>
            <th><b>Relevant Experience<b></th>
        </tr>
        <tr><td><output type='text' maxlength="30" required name='v_status'><?php echo $rowt[0]['visa_status']?></output></td>
            <td><output type='text' maxlength="30" required name='it_exp'><?php echo $rowt[0]['it_exp']?></output></td>
            <td><output type='text' maxlength="30" required name='rel_exp'><?php echo $rowt[0]['relevant_exp']?></output></td>
        </tr>
        <tr>
            <th colspan="3"><b>Description<b></th>
        </tr>
        <tr>
            <td colspan="3"><output name="description" rows="4" cols="100"></output><?php echo wordwrap($rowt[0]['description'], 100, "<br />\n");?></td>
        </tr>
        <tr>
          <th colspan="3"><b>Feedback<b></th>
        </tr>
       <tr>
         <td colspan="3"><output name="feedback" rows="4" cols="100"></output><?php echo wordwrap($rowt[0]['feedback'], 100, "<br />\n");?></td>
       </td>
     </tr>
 </table>
