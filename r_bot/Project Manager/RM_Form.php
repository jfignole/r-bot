<?php /**
* @package r_bot
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
include("../config.php");
if(!(isset( $_POST['submit']))) { ?>
<!DOCTYPE html>
<html>
<head>
	<link rel='stylesheet' href='../styles.css' type='text/css'>
  <ul> <!--Menu-->
  <li><a>R-BOT</a></li>
  <li><a href='home.php' style = "font-size:14px">Home</a></li>
  <li><a href="../logout.php" style="font-size:14px">Logout</a></li>
  </ul>
	<title>
	GPO RM Form IIB Onshore
	</title>
</head>
	<body class="emp">
    <h1>CGI</h1>
    <h2>R-Bot</h2>
		<table>
			<form method='POST' action='' >
					<tr>
							<th class='EMP'><b>POSITION TITLE</b></th>
							<th class='EMP'><b>SEAT LOCATION</b></th>
							<th class='EMP'><b>DATE SUBMITTED TO CGI</b></th>
					</tr>
					<tr>
							<td><input type="text" placeholder="Position Title" name="ptitle"></td>
							<td><input type="text" placeholder="Seat Location" name="sloc"></td>
							<td><input type="date" placeholder="mm/dd/yyyy" name="dsub"></td>
					</tr>
					<tr>
							<th class='EMP'><b># OF RESOURCES NEEDED</b></th>
							<th class='EMP'><b>PROJECT START DATE</b></th>
							<th class='EMP'><b>FIXED PRICE OR TM</b></th>
					</tr>
					<tr>
						<td><input type="number" placeholder="0" min="0" name="numres"></td>
						<td><input type="date" placeholder="mm/dd/yyyy" name="pstart"></td>
						<td><select name="TMFP">
										<option value="TM">TM</option>
										<option value="FP">FP</option>
								</select>
						</td>
					</tr>
					<tr>
							<th class='EMP'><b>TYPE</b></th>
							<th class='EMP'><b>ESTIMATED RESOURCE START DATE</b></th>
							<th class='EMP'><b>ESTIMATED END DATE</b></th>
					</tr>
					<tr>
							<td><select name="type">
											<option value="Development">Development</option>
											<option value="Testing">Testing</option>
											<option value="Support">Support</option>
											<option value="Consulting">Consulting</option>
									</select></td>
							<td><input type="date" placeholder="mm/dd/yyyy" name="rsdate"></td>
							<td><input type="date" placeholder="mm/dd/yyyy" name="rendate"></td>
					</tr>
					<tr>
							<th class='EMP'><b>RECOMMENDED HIRING</b></th>
							<th class='EMP'><b>PROJECT/CLIENT</b></th>
							<th class='EMP'><b>CONFIDENCE (0-100%)</b></th>
					</tr>
					<tr><td><select name="rec_hire">
									<option value="Direct">Direct</option>
									<option value="Temp to Perm">Temp to Perm</option>
									<option value="Contractor">Contractor</option>
							</select></td>
							<td><input type="text" name="proj_client"></td>
							<td><input type="text" name="conf_perc"></td>
					</tr>
					<tr>
					</tr>
					<tr>
							<th class='EMP'><b>HIRING MANAGER (PNC ONLY)</b></th>
							<th class='EMP'><b>CIO/SENIOR MANAGER (PNC ONLY)</b></th>
							<th class='EMP'><b>CGI ENGAGMENT MANAGER</b></th>
					</tr>
					<tr>
						<td><input type="text" placeholder="Enter Name" name="hir_manag"></td>
						<td><input type="text" placeholder="Enter Name" name="sen_manag"></td>
						<td><input type="text" placeholder="Enter Name" name="engag_manag"></td>
					</tr>
					<tr>
							<th class='EMP'><b>PROJECT CODE #</b></th>
							<th class='EMP'><b>TARGET SALARY</b></th>
							<th class='EMP'><b>RATE CARD-CATEGORY-LEVEL</b></th>
					</tr>
					<tr>
						<td><input type="number" placeholder="000000000000000" min="0" name="pcode"></td>
						<td><input type="number" placeholder="00000" min="0" name="t_salary"></td>
						<td><input type="text" placeholder="level" name="rcc_level"></td>
					</tr>
					<tr>
							<th class='EMP' colspan="3"><b>POSITION DESCRIPTION</b></th>
					</tr>
					<tr>
							<td colspan="3"><textarea id = "Position Requirements" name="posit_desc" rows="8" cols="100">Requirements and Responsibilities</textarea></td>
					</tr>
          <tr>
            <th class='EMP' colspan="3" class='EMP'><b>COMMENTS: </b></th>
          </tr>
          <td colspan="3"><textarea name="comments" rows="4" cols="100" >Comments</textarea></td>
        </tr>
					<tr>
							<th class='EMP' colspan="2"><b>NOTES (Internal Only):</b></th>
              <th class='EMP' ><b>STATUS</b></th>
					</tr>
					<tr><td colspan="2"><textarea id="Notes"  name="notes" rows="4" cols="100">Notes</textarea>
              <td><select name="status">
    									<option value="WAITING FOR SO_NUM">Waiting for SO_Number</option>
    							</select></tr>
					<tr>
						<td colspan="2"><button type="submit" name="submit" value="Submit" >Send to HR</button>
              <input type="reset" value="Reset" name="reset" class="res">
							</td>
						</form>
            </tr>
		</table>

	</body>
</html>
<?php
} else {
  $form = new rmClass;
  $form->storeFormValues($_POST);
  echo $form->processForm($_POST);#stores new RM_FORM in the database
  }
 ?>
