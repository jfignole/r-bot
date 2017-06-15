<?php /**
* @package r_bot
* @author Jonathan Fignole <jonathan.fignole@cgi.com>
* @author Tyler Patrick Steve <tyler.p.steve@cgi.com>
* @copyright  2017 CGI Group Inc.
*/

// Start browser session
session_start();
if(!isset($_SESSION['emp'])){//If session is not set, user isn't logged in.
                             //Redirect to Login Page
      header("Location:../logout.php");
      exit();
   }
include("../config.php");
$id = $_GET['id'];//Gets id from previous page and queries the database to get
//information to fill in this particular RM_FORM
$conn=new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD); //DB Connection
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Sets PDO error types
$sql = "SELECT * FROM rmemform WHERE RM_ID = '$id'";
$stmt = $conn->prepare($sql);
$stmt->execute();//Builds and runs query
$rowt = $stmt->fetchAll(PDO::FETCH_ASSOC);//Fetches query into array with column
//names instead of indexes
 if( !(isset( $_POST['submit'] ) ) ) { ?>
 <!-- Begin HTML -->
<!DOCTYPE html>
<html>
<header>
    <center>
      <img src="/images/banner_main.png" alt="Banner">
    <center>
  </header>
<head>
	<link rel='stylesheet' href='../styles.css' type='text/css'>
  <div class="container">
   <a href="home.php">Home</a>
   <a href="../logout.php">Logout</a>
  </div>
	<title>
	HR_AP_RM_FORM
	</title>
  <script type="text/javascript">
      var datefield=document.createElement("input")
      datefield.setAttribute("type", "date")
      if (datefield.type!="date"){ //if browser doesn't support input type="date", load files for jQuery UI Date Picker
          document.write('<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />\n')
          document.write('<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"><\/script>\n')
          document.write('<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"><\/script>\n') 
      }
    </script>
</head>
	<body class="emp">
		<table>
			<form method="POST" action="" >
      <tr colspan="3" class="EMP">
        <th <?php if($rowt[0]['status'] !== 'REJECTED'){?> style=display:none <?php } ?> colspan="3" class='EMP'><b>Reason for Rejection:</b></th>
      </tr>
       <tr <?php if($rowt[0]['status'] !== 'REJECTED'){?> style=display:none <?php } ?> >
          <th disabled colspan="3" class='EMP'><input id="disA1" type="text" name="rejRes" value="<?php echo $rowt[0]['rej_reason']?>"></td>
        </tr>
        <tr colspan="3" class='EMP'>
          <th colspan="3" class='EMP'><b>ID NUMBER:</b></th>
        </tr>
        <tr>
          <th colspan="3" class='EMP'><input id="disA1"
           <?php if($rowt[0]['status'] == 'RM_FORM CLOSED/ RESOURCE HIRED'){?> disabled <?php } ?>
           type="text" name="idnum" value="<?php echo $id?>"></td>
        </tr>
        <tr colspan="3" class='EMP'>
          <th class='EMP' colspan="3"><b>SO NUMBER:</b></th>
        </tr>
        <tr>
          <th class='EMP' colspan = "3"><input id="disA"
          <?php if($rowt[0]['status'] == 'RM_FORM CLOSED/ RESOURCE HIRED'){?> disabled <?php } ?> 
          type="text" placeholder="SO Number" name="soNum" value="<?php echo $rowt[0]['so_number']?>"></th>
        </tr>
			<tr>
							<th class='EMP'><b>POSITION TITLE</b></th>
							<th class='EMP'><b>SEAT LOCATION</b></th>
							<th class='EMP'><b>DATE SUBMITTED TO CGI</b></th>
					</tr>
					<tr>
							<td><input id="disA" 
              <?php if($rowt[0]['status'] == 'RM_FORM CLOSED/ RESOURCE HIRED'){?> disabled <?php } ?>
              type="text" value="<?php echo $rowt[0]['position_title']?>" name="ptitle"></output></td>
							<td><input id="disA"
              <?php if($rowt[0]['status'] == 'RM_FORM CLOSED/ RESOURCE HIRED'){?> disabled <?php } ?>
              name="sloc" type="text" value="<?php echo $rowt[0]['seat_location']?>" ></td>
							<td><input id="clndr1"
              <?php if($rowt[0]['status'] == 'RM_FORM CLOSED/ RESOURCE HIRED'){?> disabled <?php } ?>
              type="date" value="<?php echo $rowt[0]['cgi_submit_dt']?>" name="dsub">
              <script> 
              jQuery(function($){ //on document.ready
              $('#clndr1').datepicker();
              }) 
            </script></td>
					</tr>
					<tr>
							<th class='EMP'><b># OF RESOURCES NEEDED</b></th>
							<th class='EMP'><b>PROJECT START DATE</b></th>
							<th class='EMP'><b>FIXED PRICE OR TM</b></th>
					</tr>
					<tr>
						<td><input id="disA"
            <?php if($rowt[0]['status'] == 'RM_FORM CLOSED/ RESOURCE HIRED'){?> disabled <?php } ?>
            type="number" value="<?php echo $rowt[0]['num_resource_need']?>" min="0" name="numres"></td>
						<td><input id="clndr2"
            <?php if($rowt[0]['status'] == 'RM_FORM CLOSED/ RESOURCE HIRED'){?> disabled <?php } ?>
            type="date" value="<?php echo $rowt[0]['proj_start_dt']?>" name="pstart">
            <script> 
              jQuery(function($){ //on document.ready
              $('#clndr2').datepicker();
              }) 
            </script></td>
						<td><select name="TMFP" id="disA" <?php if($rowt[0]['status'] == 'RM_FORM CLOSED/ RESOURCE HIRED'){?> disabled <?php } ?>>
										<option value="TM" <?php if($rowt[0]['tmfp'] == "TM") echo "selected='selected'";?>>TM</option>
										<option value="FP" <?php if($rowt[0]['tmfp'] == "FP") echo "selected='selected'";?>>FP</option>
								</select>
						</td>
					</tr>
					<tr>
							<th class='EMP'><b>TYPE</b></th>
							<th class='EMP'><b>ESTIMATED RESOURCE START DATE</b></th>
							<th class='EMP'><b>ESTIMATED END DATE</b></th>
					</tr>
					<tr>
							<td><select name="type" id="disA" <?php if($rowt[0]['status'] == 'RM_FORM CLOSED/ RESOURCE HIRED'){?> disabled <?php } ?>>
                      <option value="Development" <?php if($rowt[0]['job_type'] == "Development") echo "selected='selected'";?> >Development</option>
                      <option value="Testing" <?php if($rowt[0]['job_type'] == "Testing") echo "selected='selected'";?>>Testing</option>
                      <option value="Support" <?php if($rowt[0]['job_type'] == "Support") echo "selected='selected'";?>>Support</option>
                      <option value="Consulting" <?php if($rowt[0]['job_type'] == "Consulting") echo "selected='selected'";?>>Consulting</option>
                    </select>
                  </td>
                    </select>
              </td>
							<td><input id="clndr3"
              <?php if($rowt[0]['status'] == 'RM_FORM CLOSED/ RESOURCE HIRED'){?> disabled <?php } ?> 
              type="date" value="<?php echo $rowt[0]['est_resource_start_dt']?>" name="rsdate">
              <script> 
              jQuery(function($){ //on document.ready
              $('#clndr3').datepicker();
              }) 
            </script></td>
							<td><input id="clndr4"
              <?php if($rowt[0]['status'] == 'RM_FORM CLOSED/ RESOURCE HIRED'){?> disabled <?php } ?> 
              type="date" value="<?php echo $rowt[0]['est_resource_end_dt']?>" name="rendate">
              <script> 
              jQuery(function($){ //on document.ready
              $('#clndr4').datepicker();
              }) 
            </script></td>
					</tr>
					<tr>
              <th class='EMP'><b>RECOMMENDED HIRING</b></th>
							<th class='EMP'><b>PROJECT/CLIENT</b></th>
							<th class='EMP'><b>CONFIDENCE (0-100%)</b></th>
					</tr>
					<tr>
            <td><select name="rec_hire" id="disA" <?php if($rowt[0]['status'] == 'RM_FORM CLOSED/ RESOURCE HIRED'){?> disabled <?php } ?>>
                    <option value="Direct" <?php if($rowt[0]['recommended_hiring'] == "Direct") echo "selected='selected'";?>>Direct</option>
                    <option value="Temp to Perm" <?php if($rowt[0]['recommended_hiring'] == "Temp to Perm") echo "selected='selected'";?>>Temp to Perm</option>
                    <option value="Contractor" <?php if($rowt[0]['recommended_hiring'] == "Contractor") echo "selected='selected'";?>>Contractor</option>
                </select>
            </td>
							<td><input id="disA"
              <?php if($rowt[0]['status'] == 'RM_FORM CLOSED/ RESOURCE HIRED'){?> disabled <?php } ?> 
              type="text" name="proj_client" value="<?php echo $rowt[0]['proj_client']?>"></td>
							<td><input id="disA"
              <?php if($rowt[0]['status'] == 'RM_FORM CLOSED/ RESOURCE HIRED'){?> disabled <?php } ?> 
              type="text" name="conf_perc" value="<?php echo $rowt[0]['confidence']?>" min="0" max="100"></td>
					</tr>
					<tr>
					</tr>
					<tr>
							<th class='EMP'><b>HIRING MANAGER (PNC ONLY)</b></th>
							<th class='EMP'><b>CIO/SENIOR MANAGER (PNC ONLY)</b></th>
							<th class='EMP'><b>CGI ENGAGMENT MANAGER</b></th>
					</tr>
					<tr>
						<td><input id="disA"
            <?php if($rowt[0]['status'] == 'RM_FORM CLOSED/ RESOURCE HIRED'){?> disabled <?php } ?> 
            type="text" value="<?php echo $rowt[0]['hiring_manager']?>" name="hir_manag"></td>
						<td><input id="disA"
            <?php if($rowt[0]['status'] == 'RM_FORM CLOSED/ RESOURCE HIRED'){?> disabled <?php } ?> 
            type="text" value="<?php echo $rowt[0]['senior_manager']?>" name="sen_manag"></td>
						<td><input id="disA"
            <?php if($rowt[0]['status'] == 'RM_FORM CLOSED/ RESOURCE HIRED'){?> disabled <?php } ?> 
            type="text" value="<?php echo $rowt[0]['cgi_engage_manager']?>" name="engag_manag"></td>
					</tr>
					<tr>
							<th class='EMP'><b>PROJECT CODE #</b></th>
							<th class='EMP'><b>TARGET SALARY</b></th>
							<th class='EMP'><b>RATE CARD-CATEGORY-LEVEL</b></th>
					</tr>
					<tr>
						<td><input id="disA"
            <?php if($rowt[0]['status'] == 'RM_FORM CLOSED/ RESOURCE HIRED'){?> disabled <?php } ?> 
            type="number" value="<?php echo $rowt[0]['proj_code']?>" min="0" name="pcode"></td>
						<td><input id="disA"
            <?php if($rowt[0]['status'] == 'RM_FORM CLOSED/ RESOURCE HIRED'){?> disabled <?php } ?>
            type="number" value="<?php echo $rowt[0]['target_salary']?>" min="0" name="t_salary"></td>
						<td><input id="disA"
            <?php if($rowt[0]['status'] == 'RM_FORM CLOSED/ RESOURCE HIRED'){?> disabled <?php } ?>
            type="text" value="<?php echo $rowt[0]['rate_crd_cat_lvl']?>" name="rcc_level"></td>
					</tr>
					<tr>
							<th class='EMP' colspan="3"><b>POSITION DESCRIPTION</b></th>
					</tr>
					<tr>
							<td colspan="3" class="input"><textarea id="Position Requirements"
              <?php if($rowt[0]['status'] == 'RM_FORM CLOSED/ RESOURCE HIRED'){?> disabled <?php } ?>
              name="posit_desc" rows="8" cols="100"><?php echo $rowt[0]['position_desc']?></textarea></td>
					</tr>
          <tr>
            <th class='EMP' colspan="3" class='EMP'><b>COMMENTS: </b></th>
          </tr>
          <td colspan="3" class="input"><textarea id="disA"
          <?php if($rowt[0]['status'] == 'RM_FORM CLOSED/ RESOURCE HIRED'){?> disabled <?php } ?>
          name="comments" rows="4" cols="100" ><?php echo $rowt[0]['comments']?></textarea></td>
        </tr>
          <tr>
							<th class='EMP' colspan="2"><b>NOTES (Internal Only):</b></th>
              <th class='EMP' ><b>STATUS</b></th>
					</tr>
					<tr><td colspan="2" class="input"><textarea id="Notes"
          <?php if($rowt[0]['status'] == 'RM_FORM CLOSED/ RESOURCE HIRED'){?> disabled <?php } ?>
          name="notes" rows="4" cols="100"><?php echo $rowt[0]['notes']?></textarea>
              <td><select name="status" id="disA" <?php if($rowt[0]['status'] == 'RM_FORM CLOSED/ RESOURCE HIRED'){?> disabled <?php } ?>>
                      <option value="WAITING FOR VENDOR RESPONSE" <?php if($rowt[0]['status'] == "WAITING FOR VENDOR RESPONSE") echo "selected='selected'";?>>Waiting for Vendor Response</option>
                      <option value="WAITING FOR SO_NUM" <?php if($rowt[0]['status'] == "WAITING FOR SO_NUM") echo "selected='selected'";?>>Waiting for SO_NUM</option>
    							</select></td></tr>
					<tr>
						<td colspan="3"><button <?php if($rowt[0]['status'] == 'RM_FORM CLOSED/ RESOURCE HIRED'){?> disabled <?php } ?> 
            type="submit" name="submit" value="Send to Vendor" >Update Form</button>
              <input <?php if($rowt[0]['status'] == 'RM_FORM CLOSED/ RESOURCE HIRED'){?> disabled <?php } ?>
              type="reset" value="Reset" name="reset" class="res">
            </td>
          </form>
          </tr>
  </table>
	</body>
</html>
<?php
// Loop condition start
} else {
  try {
    $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Update a RM_FORM with newly added/ changed info
    // Will retain previous added info, each elemnt is described below to be updated/ kept
    $sql = "UPDATE rmemform SET position_title = :ptitle, seat_location = :sloc, cgi_submit_dt = :dsub,
      num_resource_need = :numres, proj_start_dt = :pstart, tmfp = :TMFP, job_type = :type, est_resource_start_dt = :rsdate,
      est_resource_end_dt = :rendate, proj_client = :proj_client, confidence = :conf_perc, hiring_manager = :hir_manag, senior_manager = :sen_manag,
      cgi_engage_manager = :engag_manag, proj_code = :pcode, target_salary = :t_salary, rate_crd_cat_lvl = :rcc_level, position_desc = :posit_desc,
      recommended_hiring = :rec_hire, notes = :notes, so_number = :soNum, comments = :comments, status = :status WHERE RM_ID = '$id'";
    $stmt = $con->prepare($sql); // Prepare the above SQL statement
    $stmt->execute(array( // Execute the SQL statement
      ':ptitle' => $_POST['ptitle'], // POST position_title
      ':sloc' => $_POST['sloc'], // POST seat location
      ':dsub' => date("Y-m-d", strtotime($_POST['dsub'])), // POST Date of submittion
      ':numres' => $_POST['numres'], // POST number of resources needed
      ':pstart' => date("Y-m-d", strtotime($_POST['pstart'])), // POST position start date
      ':TMFP' => $_POST['TMFP'], // POST TMFP
      ':type' => $_POST['type'], // POST job type
      ':rsdate' => date("Y-m-d", strtotime($_POST['rsdate'])), // POST resource start date
      ':rendate' => date("Y-m-d", strtotime($_POST['rendate'])), // POST resource end date
      ':proj_client' => $_POST['proj_client'], // POST project client
      ':conf_perc' => $_POST['conf_perc'], // POST confidence percentage
      ':hir_manag' => $_POST['hir_manag'], // POST Hiring manager
      ':sen_manag' => $_POST['sen_manag'], // POST senior manager (PNC)
      ':engag_manag' => $_POST['engag_manag'], // POST engagement manage (PNC)
      ':pcode' => $_POST['pcode'], // POST project code
      ':t_salary' => $_POST['t_salary'], // POST target salary
      ':rcc_level' => $_POST['rcc_level'], // POST rating level
      ':posit_desc' => $_POST['posit_desc'], // POST position description
      ':rec_hire' => $_POST['rec_hire'], // POST recommended hiring
      ':notes' => $_POST['notes'], // POST notes
      ':soNum' => $_POST['soNum'], // POST SO_NUMBER
      ':comments' => $_POST['comments'], // POST comments
      ':status' => $_POST['status'] // POST status
    ));
    $correct = true;
    // JS to prompt success and redirect apge
    echo "<script type=\"text/javascript\">
                      if (window.confirm('Form updated'))
                      {
                          window.location = 'home.php'
                      }else{
                          window.location = 'home.php'
                      }
                      </script> ";
  // Error handling
  }catch(PDOException $e) {
    $correct = false;
    return $e->getMessage();
  }
}
?>
