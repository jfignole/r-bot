<?php /**
* @package r_bot
* @author Jonathan Fignole <jonathan.fignole@cgi.com>
* @copyright  2017 CGI Group Inc.
*/
session_start();
if(!isset($_SESSION['vend'])) // If session is not set, user isn't logged in.
                             // Redirect to Login Page
       {
           header("Location:../logout.php");
           exit();
       }
include("../config.php");
$id = $_GET['id']; // gets id from previous page and queries the database to get
                   // information to fill in this particular RM_FORM
$conn=new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD); // DB Connection
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);// sets PDO error types
$sql = "SELECT * FROM rmemform WHERE RM_ID = '$id'";
$stmt = $conn->prepare($sql);
$stmt->execute(); // builds and runs query
$rowt = $stmt->fetchAll(PDO::FETCH_ASSOC);// fetches query into array with column
// names instead of indexes
 if(!(isset($_POST['submit']))) { ?>
 <!DOCTYPE html>
 <html>
 <header>
    <img src="/images/banner_main.png" alt="Banner">
  </header>
   <head>
      <!-- call to webAPI JQuery -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <link rel='stylesheet' href='../styles.css' type='text/css'>
      <div class="container">
       <a href="vendorHome.php">Home</a>
       <a href="feedbackList.php">Feedback</a>
       <a href="../logout.php">Logout</a>
      </div>
      <title>Vendor Application</title>
   </head>
   <body class="vndr">
     <h3>Application</h3>
     <table>
       <!-- iframe to be used to avoid page redirect on submit -->
       <iframe name="inpFm" style="display:none;"></iframe>
       <form id="myForm" action="" method="post" target="inpFm">
         <tr><th colspan="3" class='VEND'><b>Job SO Number</b></th></tr>
         <tr><td colspan="3"><output type='text' maxlength='30' required name='so_number'><?php echo $rowt[0]['so_number']?></output></td></tr>
         <tr><th class='VEND'><b>Name</b></th>
             <th class='VEND'><b>Phone Number</b></th>
             <th class='VEND'><b>Best Time to Call</b></th>
         </tr>
         <tr><td><input type='text' maxlength="30" required name='name'/></td>
             <td><input type="tel" maxlength="30" required name="p_num" size="35"/></td>
             <td><input type='text' maxlength="30" required name='bc_time'/></td>
         </tr>
         <tr>
             <th class='VEND'><b>Visa Status</b></th>
             <th class='VEND'><b>IT Experience</b></th>
             <th class='VEND'><b>Relevant Experience</b></th>
         </tr>
         <tr>
             <td><input type='text' maxlength="30" required name='v_status'/></td>
             <td><input type='text' maxlength="30" required name='it_exp'/></td>
             <td><input type='text' maxlength="30" required name='rel_exp'/></td>
         </tr>
         <tr>
             <th class='VEND'><b>Requested Salary</b></th>
             <th class='VEND' colspan="2"><b>Description</b></th>
         </tr>
         <tr>
             <td><input type="number" placeholder="000000" min="0" name="req_salary"></td>
             <td colspan="2"><textarea name="description" rows="4" cols="100" placeholder="Description"></textarea></td>
         </tr>
         <tr><td colspan="3"><input type='submit' name='submit' value='Submit'/>
           <input type='button' name="cancel" value="Cancel" onclick="location.href='vendorHome.php'" />
           <input type='button' name="rt" value="Reset" onclick="resetForm()"/></td></tr>
        <tr><th class='VEND' colspan="3"><b>Upload CV</b></th></tr>
        </form>
        <iframe name="fileFm" style="display:none;"></iframe>
        <form id="myForm2" method="post" enctype="multipart/form-data" target="fileFm">
        <tr>
            <td colspan ="3"><input type="file" name="pdfFile" /><input id="other" type="submit" value="Submit" name="btn-upload"/></td>
        </tr>
      </form>
    </table>
    <!-- JS to reset both forms onclick of reset button -->
    <script language="javascript">
      function resetForm() {
          document.getElementById('myForm').reset();
          document.getElementById('myForm2').reset();
      }
    </script>
    <?php if(isset($_POST['btn-upload'])) // action to be called on uplaod on file
    {
      // Variables to parse through the file and create elements for each type needed for proper uplaod
      $file = $_FILES['pdfFile']['name'];
      $tmp_dir = $_FILES['pdfFile']['tmp_name'];
      $fileSize = $_FILES['pdfFile']['size'];
      // If upload empty throws error
      if(empty($file)){
        $errMSG = "Please Select a File";
      }
      else {
        $folder="../uploads/"; // upload Directory
        $filExt = strtolower(pathinfo($file,PATHINFO_EXTENSION)); // get file extension
        $val_ext = array('pdf', 'doc', 'docx'); // valid file extensions
        // allow valid file formats
        if(in_array($filExt, $val_ext)){
          // check File size '1MB'
          if($fileSize < 1000000) {
            try{
              // moves uploaded file fails throws error(s) listed below
              if(!move_uploaded_file($tmp_dir,$folder.$file)){
                throw new Exception('Could not move file');
              }
          }catch(Exception $e) {
             echo'File did not upload: '  .$_FILES["pdfFile"]["error"];
          }
        }
          else{
            $errMSG = "Sorry, your file is too large.";
          }
        }
        else{
          $errMSG = "Sorry, only PDF, DOC & DOCX files are allowed.";
        }
      }
      // if no error occured, continue...
      if(!isset($errMSG))
      {
        // Parses file to be moved into DB and update table associated to the files uploaded
        $id = $rowt[0]['so_number'];
        $query = $conn->prepare('INSERT INTO files (fileName, fileActual, file_type,
		file_size, so_number) VALUES (:fName, :fActual, :fType, :fSize, :so_number)');
        $query->bindParam(':fName',$file);
        $query->bindParam(':fActual',$newFile);
        $query->bindParam(':fType',$filExt);
        $query->bindParam(':fSize',$fileSize);
        $query->bindParam('so_number', $id);
        if($query->execute())
        {
          // Success JS alert to show suer success
          $successMSG = "{$file} successfully Added";
          echo "<script language='javascript'>";
          echo "var msg = '$successMSG';";
          echo "alert(msg)";
          echo "</script>";
        }
        // if error, throws error message
        else {
          $errMSG = "error while uploading....";
        }
      }
    }
?>
<!-- Begin HTML output for RM_FORM dispaly -->
      <h3>RM_Form</h3>
      <table>
        <tr colspan="3" class='HR'>
          <th colspan="3" class='HR'><b>ID NUMBER:</b></th>
        </tr>
        <tr>
          <th colspan="3" class='HR'><output type="text" name="idnum"><?php echo $rowt[0]['RM_ID']?></output></th>
        </tr>
          <tr colspan="3" class='HR'>
            <th class='HR' colspan="3"><b>SO NUMBER:</b></th>
          </tr>
          <tr>
            <th class='HR' colspan = "3"><output type="text" name="so_number"><?php echo $rowt[0]['so_number']?></output></th>
          </tr>
  			<tr>
  							<th class='HR'><b>POSITION TITLE</b></th>
  							<th class='HR'><b>SEAT LOCATION</b></th>
  							<th class='HR'><b>DATE SUBMITTED TO CGI</b></th>
  					</tr>
  					<tr>
  							<td><output type="text" name="ptitle"><?php echo $rowt[0]['position_title']?></output></td>
  							<td><output name="sloc" type="text" ><?php echo $rowt[0]['seat_location']?></output></td>
  							<td><output type="date"  name="dsub"><?php echo $rowt[0]['cgi_submit_dt']?></output></td>
  					</tr>
  					<tr>
  							<th class='HR'><b>#  OF RESOURCES NEEDED</b></th>
  							<th class='HR'><b>PROJECT START DATE</b></th>
  							<th class='HR'><b>FIXED PRICE OR TM</b></th>
  					</tr>
  					<tr>
  						<td><output type="text"  min="0" name="numres"><?php echo $rowt[0]['num_resource_need']?></output></td>
  						<td><output type="date"  name="pstart"><?php echo $rowt[0]['proj_start_dt']?></output></td>
  						<td><output name="TMFP" ><?php echo $rowt[0]['tmfp']?></output></td>
  					</tr>
  					<tr>
  							<th class='HR'><b>TYPE</b></th>
  							<th class='HR'><b>ESTIMATED RESOURCE START DATE</b></th>
  							<th class='HR'><b>ESTIMATED END DATE</b></th>
  					</tr>
  					<tr>
  							<td><output name="type" ><?php echo $rowt[0]['job_type']?></output></td>
  							<td><output type="date"  name="rsdate"><?php echo $rowt[0]['est_resource_start_dt']?></output></td>
  							<td><output type="date"  name="rendate"><?php echo $rowt[0]['est_resource_end_dt']?></output></td>
  					</tr>
  					<tr>
                <th class='HR'><b>RECOMMENDED HIRING</b></th>
  							<th class='HR'><b>PROJECT/CLIENT</b></th>
  							<th class='HR'><b>CONFIDENCE (0-100%)</b></th>
  					</tr>
  					<tr>
              <td><output name="rec_hire" ><?php echo $rowt[0]['recommended_hiring']?></output></td>
  							<td><output type="text" name="proj_client" ><?php echo $rowt[0]['proj_client']?></output></td>
  							<td><output type="text" name="conf_perc"  min="0" max="100"><?php echo $rowt[0]['confidence']?></output></td>
  					</tr>
  					<tr>
  					</tr>
  					<tr>
  							<th class='HR'><b>HIRING MANAGER (PNC ONLY)</b></th>
  							<th class='HR'><b>CIO/SENIOR MANAGER (PNC ONLY)</b></th>
  							<th class='HR'><b>CGI ENGAGMENT MANAGER</b></th>
  					</tr>
  					<tr>
  						<td><output type="text"  name="hir_manag"><?php echo $rowt[0]['hiring_manager']?></output></td>
  						<td><output type="text"  name="sen_manag"><?php echo $rowt[0]['senior_manager']?></output></td>
  						<td><output type="text"  name="engag_manag"><?php echo $rowt[0]['cgi_engage_manager']?></output></td>
  					</tr>
  					<tr>
  							<th class='HR'><b>PROJECT CODE #</b></th>
  							<th class='HR'><b>TARGET SALARY</b></th>
  							<th class='HR'><b>RATE CARD-CATEGORY-LEVEL</b></th>
  					</tr>
  					<tr>
  						<td><output type="text"  min="0" name="pcode"><?php echo $rowt[0]['proj_code']?></output></td>
  						<td><output type="text"  min="0" name="t_salary"><?php echo $rowt[0]['target_salary']?></output></td>
  						<td><output type="text"  name="rcc_level"><?php echo $rowt[0]['rate_crd_cat_lvl']?></output></td>
  					</tr>
  					<tr>
  							<th class='HR' colspan="3"><b>POSITION DESCRIPTION</b></th>
  					</tr>
  					<tr>
  						<td colspan="3"><output id ="Position Requirements" name="posit_desc" rows="20" cols="100" class="input"><?php echo wordwrap($rowt[0]['position_desc'], 120, "<br />\n");?></output></td>
  					</tr>
            <tr>
              <th class='EMP' colspan="3" class='EMP'><b>COMMENTS: </b></th>
            </tr>
            <td colspan="3"><textarea disabled name="comments" rows="4" cols="100" ><?php echo $rowt[0]['comments']?></textarea></td>
          </tr>
		</table>
   </body>
 </html>
 <?php
  } else {
    $vndr = new vendors; // selects query script statement
    $vndr->storeFormValues( $_POST ); // move values from POST to $vndr variable
    echo $vndr->insertForm($_POST);// stores new vendor info in the database
    $id = $rowt[0]['RM_ID']; // grabs page $id value
    try {
      $status = 'APPLICATION RECEIVED'; // update status
      $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD); // sets DB username and password
      $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "UPDATE rmemform SET status = :status WHERE RM_ID = '$id'"; // SQL statement that updates rmemform table
      $stmt = $con->prepare($sql); // prepare the SQL statement
      // execute SQL statement
      $stmt->execute(array(
        ':status' => $status
      ));
    // error handling
    }catch(PDOException $e) {
      $correct = false;
      echo $e->getMessage();
      }
    }
 ?>
