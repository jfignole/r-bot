<?php
//start session
session_start();
include("config.php");

// Create connection
/*$db = mysqli_connect('localhost', 'root', 'cgi@1234', 'r_bot');
// Check connection
if ($db->connect_error) {
    die('Connection failed: [' . $conn->connect_error . ']');
}
else
    echo('Connection Succeded');*/
//check for form submit
 if(isset($_POST['submit'])) {

    $ptitle = $_POST['ptitle'];
    $sloc = $_POST['sloc'];
    $dsub = $_POST['dsub'];
    $numres = $_POST['numres'];
    $pstart = $_POST['pstart'];
    $TMFP = $_POST['TMFP'];
    $type = $_POST['type'];
    $rsdate = $_POST['rsdate'];
    $rendate = $_POST['rendate'];
    $proj_client = $_POST['proj_client'];
    $conf_perc = $_POST['conf_perc'];
    $hir_manag = $_POST['hir_manag'];
    $sen_manag = $_POST['sen_manag'];
    $engag_manag = $_POST['engag_manag'];
    $pcode = $_POST['pcode'];
    $t_salary = $_POST['t_salary'];
    $rcc_level = $_POST['rcc_level'];
    $posit_desc = $_POST['posit_desc'];
    $rec_hire = $_POST['rec_hire'];
    $notes = $_POST['notes'];
// clean user inputs to prevent sql injections
    $ptitle = mysqli_real_escape_string($db, $ptitle);
    $sloc = mysqli_real_escape_string($db, $sloc);
    $dsub = mysqli_real_escape_string($db, $dsub);
    $numres = mysqli_real_escape_string($db, $numres);
    $pstart = mysqli_real_escape_string($db, $pstart);
    $TMFP = mysqli_real_escape_string($db, $TMFP);
    $type = mysqli_real_escape_string($db, $type);
    $rsdate = mysqli_real_escape_string($db, $rsdate);
    $rendate = mysqli_real_escape_string($db, $rendate);
    $proj_client = mysqli_real_escape_string($db, $proj_client);
    $conf_perc = mysqli_real_escape_string($db, $conf_perc);
    $hir_manag = mysqli_real_escape_string($db, $hir_manag);
    $sen_manag = mysqli_real_escape_string($db, $sen_manag);
    $engag_manag = mysqli_real_escape_string($db, $engag_manag);
    $pcode = mysqli_real_escape_string($db, $pcode);
    $t_salary = mysqli_real_escape_string($db, $t_salary);
    $rcc_level = mysqli_real_escape_string($db, $rcc_level);
    $posit_desc = mysqli_real_escape_string($db, $posit_desc);
    $rec_hire = mysqli_real_escape_string($db, $rec_hire);
    $notes = mysqli_real_escape_string($db, $notes);
    $record = "New Record created successfully";


    $query = "INSERT INTO rmemform VALUES ('$ptitle', '$sloc', '$dsub', '$numres', '$pstart', '$TMFP', '$type', '$rsdate', '$rendate', '$proj_client', '$conf_perc', '$hir_manag', '$sen_manag', '$engag_manag',
       '$pcode', '$t_salary', '$rcc_level', '$posit_desc', '$rec_hire', '$notes');";
          if($db->query($query) === TRUE) {
      echo $record;
    } else {

    }
    $copy = "INSERT INTO rmhrform SELECT * FROM rmemform;";
  }

  if(isset($_POST['btn_a']))
  {
    $to = 'jbfignole@gmail.com';

    $subject = 'RMForm Completed';
    $message = 'The RMForm has been completed. Requesting approval and SO Number';
    $headers = 'From: jonathan.fignole@gmail.com' . "\r\n" .
      'Reply-To: jonathan.fignole@gmail.com' . "\r\n" .
      'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);
    print_r(error_get_last());
    echo 'Email Sent.';
  }

 ?>




<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="styles.css">
	<title>
	GPO RM Form IIB Onshore
	</title>
</head>
	<body>
		<h1>CGI</h1>
		<table>
			<form method='POST' action='' >
					<tr>
							<th><b>POSITION TITLE</b></th>
							<th><b>SEAT LOCATION</b></th>
							<th><b>DATE SUBMITTED TO CGI</b></th>
					</tr>
					<tr>
							<td><input type="text" placeholder="Position Title" name="ptitle"></td>
							<td><input type="text" placeholder="Seat Location" name="sloc"></td>
							<td><input type="date" placeholder="mm/dd/yyyy" name="dsub"></td>
					</tr>
					<tr>
							<th><b># OF RESOURCES NEEDED</b></th>
							<th><b>PROJECT START DATE</b></th>
							<th><b>FIXED PRICE OR TM</b></th>
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
							<th><b>TYPE</b></th>
							<th><b>ESTIMATED RESOURCE START DATE</b></th>
							<th><b>ESTIMATED END DATE</b></th>
					</tr>
					<tr>
							<td rowspan="4"><input type="radio" name="type" value="development">Development<br>
							<input type="radio" name="type" value="testing">Testing<br>
							<input type="radio" name="type" value="support">Support<br>
							<input type="radio" name="type" value="consulting">Consulting</td>
							<td><input type="date" placeholder="mm/dd/yyyy" name="rsdate"></td>
							<td><input type="date" placeholder="mm/dd/yyyy" name="rendate"></td>
					</tr>
					<tr>
							<th><b>PROJECT/CLIENT</b></th>
							<th><b>CONFIDENCE (0-100%)</b></th>
					</tr>
					<tr>
							<td><input type="text" name="proj_client"></td>
							<td><input type="number" name="conf_perc" min="0" max="100"></td>
					</tr>
					<tr>
					</tr>
					<tr>
							<th><b>HIRING MANAGER (PNC ONLY)</b></th>
							<th><b>CIO/SENIOR MANAGER (PNC ONLY)</b></th>
							<th><b>CGI ENGAGMENT MANAGER</b></th>
					</tr>
					<tr>
						<td><input type="text" placeholder="Enter Name" name="hir_manag"></td>
						<td><input type="text" placeholder="Enter Name" name="sen_manag"></td>
						<td><input type="text" placeholder="Enter Name" name="engag_manag"></td>
					</tr>
					<tr>
							<th><b>PROJECT CODE #</b></th>
							<th><b>TARGET SALARY</b></th>
							<th><b>RATE CARD-CATEGORY-LEVEL</b></th>
					</tr>
					<tr>
						<td><input type="number" placeholder="000000000000000" min="0" name="pcode"></td>
						<td><input type="number" placeholder="00000" min="0" name="t_salary"></td>
						<td><input type="text" placeholder="level" name="rcc_level"></td>
					</tr>
					<tr>
							<th colspan="3"><b>POSITION DESCRIPTION</b></th>
					</tr>
					<tr>
							<td colspan="3"><textarea id = "Position Requirements" name="posit_desc" rows="8" cols="100">Requirements and Responsibilities</textarea></td>
					</tr>
					<tr>
							<th><b>RECOMMENDED HIRING</b></th>
							<th colspan="2"><b>NOTES (Optional):</b></th>
					</tr>
					<tr>
						<td rowspan="3"><input type="radio" name="rec_hire" value="Direct">Direct<br>
						<input type="radio" name="rec_hire" value="Temp to Perm">Temp to Perm<br>
					  <input type="radio" name="rec_hire" value="Contractor">Contractor</td>
						<td colspan="2"><textarea id="Notes"  name="notes" rows="8" cols="65.9">Notes</textarea></td>
					</tr>
					<tr>
						<tr></tr>
						<td colspan="3"><button type="submit" name="submit" value="Submit" >Submit Form</button>
              <input type="reset" value="Reset" name="reset" class="res">
              <input type="hidden" name="btn_a" value="1" />
            </form>
              <input name="logout" type="submit" value="Logout" onclick="location.href='logout.php'"></td>
					</tr>

		</table>
	</body>
</html>
