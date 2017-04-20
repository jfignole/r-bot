<?php /**
* @package r_bot
* @author Jonathan Fignole <jonathan.fignole@cgi.com>
* @copyright  2017 CGI Group Inc.
*/
session_start();
if(!isset($_SESSION['hr'])){
           header("Location:../logout.php");
           exit();
       }
include("../config.php");
$id = $_GET['id'];#Gets id from previous page and queries the database to get
                   #information to fill in this particular RM_FORM
$conn=new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD); #DB Connection
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);#Sets PDO error types
$sql = "SELECT * FROM rmemform WHERE RM_ID = '$id'";
$stmt = $conn->prepare($sql);
$stmt->execute();#Builds and runs query
$rowt = $stmt->fetchAll(PDO::FETCH_ASSOC);#Fetches query into array with column
                                          #names instead of indexes
 if(!(isset($_POST['submit']))) { ?>
<!DOCTYPE html>
<html>
<head>
	<link rel='stylesheet' href='../styles.css' type='text/css'>
  <ul>
  <li><a>R-BOT</a></li>
  <li><a href='hrHome.php' style="font-size:14px">Home</a></li>
  <li><a href="../logout.php" style="font-size:14px">Logout</a></li>
  </ul>
	<title>
    HR_RM_FORM
	</title>
</head>
	<body class="hnr">
    <h1>CGI</h1>
    <h2>R-Bot</h2>
		<table>
			<form method="POST" action="" >
        <tr colspan="3" class='HR'>
          <th colspan="3" class='HR'><b>ID NUMBER:</b></th>
        </tr>
        <tr>
          <th colspan="3"><input type="text" name="idnum" value="<?php echo $id ?>"></td>
        </tr>
        <tr colspan="3" class='HR'>
          <th class='HR' colspan="3"><b>SO NUMBER:</b></th>
        </tr>
        <tr>
          <th class='HR' colspan = "3"><input type="text" placeholder"SO Number" name="soNum"></th>
        </tr>
        <tr><th class='HR'><b>REJECT</b></th>
            <th colspan="2" class="HR"><b>REASON FOR REJECTION</b></th>
        </tr>
        <tr><td><select name ="rej_opt">
                    <option value="YES">YES</option>
                    <option value="NO">NO</option>
            </td>
            <td colspan="2"><textarea  name="rej_reason" rows="4" cols="60"></textarea></td>
        </tr>
			  <tr>
							<th class='HR'><b>POSITION TITLE</b></th>
							<th class='HR'><b>SEAT LOCATION</b></th>
							<th class='HR'><b>DATE SUBMITTED TO CGI</b></th>
					</tr>
					<tr>
							<td><input type="text" value="<?php echo $rowt[0]['position_title']?>" name="ptitle"></output></td>
							<td><input name="sloc" type="text" value="<?php echo $rowt[0]['seat_location']?>" ></td>
							<td><input type="date" value="<?php echo $rowt[0]['cgi_submit_dt']?>" name="dsub"></td>
					</tr>
					<tr>
							<th class='HR'><b># OF RESOURCES NEEDED</b></th>
							<th class='HR'><b>PROJECT START DATE</b></th>
							<th class='HR'><b>FIXED PRICE OR TM</b></th>
					</tr>
					<tr>
						<td><input type="text" value="<?php echo $rowt[0]['num_resource_need']?>" min="0" name="numres"></td>
						<td><input type="date" value="<?php echo $rowt[0]['proj_start_dt']?>" name="pstart"></td>
						<td><select name="TMFP">
										<option value="TM" <?php if($rowt[0]['tmfp'] == "TM") echo "selected='selected'";?>>TM</option>
										<option value="FP" <?php if($rowt[0]['tmfp'] == "FP") echo "selected='selected'";?>>FP</option>
								</select>
						</td>
					</tr>
					<tr>
							<th class='HR'><b>TYPE</b></th>
							<th class='HR'><b>ESTIMATED RESOURCE START DATE</b></th>
							<th class='HR'><b>ESTIMATED END DATE</b></th>
					</tr>
					<tr>
							<td><select name="type">
                      <option value="Development" <?php if($rowt[0]['job_type'] == "Development") echo "selected='selected'";?> >Development</option>
                      <option value="Testing" <?php if($rowt[0]['job_type'] == "Testing") echo "selected='selected'";?>>Testing</option>
                      <option value="Support" <?php if($rowt[0]['job_type'] == "Support") echo "selected='selected'";?>>Support</option>
                      <option value="Consulting" <?php if($rowt[0]['job_type'] == "Consulting") echo "selected='selected'";?>>Consulting</option>
                    </select>
                  </td>
                    </select>
              </td>
							<td><input type="date" value="<?php echo $rowt[0]['est_resource_start_dt']?>" name="rsdate"></td>
							<td><input type="date" value="<?php echo $rowt[0]['est_resource_end_dt']?>" name="rendate"></td>
					</tr>
					<tr>
              <th class='HR'><b>RECOMMENDED HIRING</b></th>
							<th class='HR'><b>PROJECT/CLIENT</b></th>
							<th class='HR'><b>CONFIDENCE (0-100%)</b></th>
					</tr>
					<tr>
            <td><select name="rec_hire">
                    <option value="Direct" <?php if($rowt[0]['recommended_hiring'] == "Direct") echo "selected='selected'";?>>Direct</option>
                    <option value="Temp to Perm" <?php if($rowt[0]['recommended_hiring'] == "Temp to Perm") echo "selected='selected'";?>>Temp to Perm</option>
                    <option value="Contractor" <?php if($rowt[0]['recommended_hiring'] == "Contractor") echo "selected='selected'";?>>Contractor</option>
                </select>
            </td>
							<td><input type="text" name="proj_client" value="<?php echo $rowt[0]['proj_client']?>"></td>
							<td><input type="text" name="conf_perc" value="<?php echo $rowt[0]['confidence']?>" min="0" max="100"></td>
					</tr>
					<tr>
					</tr>
					<tr>
							<th class='HR'><b>HIRING MANAGER (PNC ONLY)</b></th>
							<th class='HR'><b>CIO/SENIOR MANAGER (PNC ONLY)</b></th>
							<th class='HR'><b>CGI ENGAGMENT MANAGER</b></th>
					</tr>
					<tr>
						<td><input type="text" value="<?php echo $rowt[0]['hiring_manager']?>" name="hir_manag"></td>
						<td><input type="text" value="<?php echo $rowt[0]['senior_manager']?>" name="sen_manag"></td>
						<td><input type="text" value="<?php echo $rowt[0]['cgi_engage_manager']?>" name="engag_manag"></td>
					</tr>
					<tr>
							<th class='HR'><b>PROJECT CODE #</b></th>
							<th class='HR'><b>TARGET SALARY</b></th>
							<th class='HR'><b>RATE CARD-CATEGORY-LEVEL</b></th>
					</tr>
					<tr>
						<td><input type="text" value="<?php echo $rowt[0]['proj_code']?>" min="0" name="pcode"></td>
						<td><input type="text" value="<?php echo $rowt[0]['target_salary']?>" min="0" name="t_salary"></td>
						<td><input type="text" value="<?php echo $rowt[0]['rate_crd_cat_lvl']?>" name="rcc_level"></td>
					</tr>
					<tr>
							<th class='HR' colspan="3"><b>POSITION DESCRIPTION</b></th>
					</tr>
					<tr>
							<td colspan="3"><textarea id = "Position Requirements" name="posit_desc" rows="8" cols="100"><?php echo $rowt[0]['position_desc']?></textarea></td>
					</tr>
          <tr>
            <th class='EMP' colspan="3" class='EMP'><b>COMMENTS: </b></th>
          </tr>
          <td colspan="3"><textarea name="comments" rows="4" cols="100" ><?php echo $rowt[0]['comments']?></textarea></td>
        </tr>
          <tr>
							<th class='HR' colspan="2"><b>NOTES (Internal Only):</b></th>
              <th class='HR' ><b>STATUS</b></th>
					</tr>
					<tr><td colspan="2"><textarea id="Notes"  name="notes" rows="4" cols="100"><?php echo $rowt[0]['notes']?></textarea>
              <td><select name="status">
    									<option value="SO_NUM APPLIED" <?php if($rowt[0]['status'] == "SO_NUM APPLIED") echo "selected='selected'";?>>SO_Number Applied</option>
                      <option value="REJECTED" <?php if($rowt[0]['status'] == "REJECTED") echo "selected='selected'";?>>REJECTED</option>
    							</select></tr>
					<tr>
						<td colspan="3"><button type="submit" name="submit" value="Submit" >Submit Form</button>
              <input type="reset" value="Reset" name="reset" class="res"></td>
            </td>
          </tr>
        </form>
  </table>
	</body>
</html>
<?php
} else {
  if(empty($_POST['soNum'])){
    echo "SO_Number required. No changes applied. <a href=\"javascript:history.go(-1)\">GO BACK</a>";
  }else {
    if($_POST['rej_opt'] == 'YES' && empty($_POST['rej_reason'])){
      echo "Reason for Rejection Required. No changes applied. <a href=\"javascript:history.go(-1)\">GO BACK</a>";
    }else {
  try{
  $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "UPDATE rmemform SET position_title = :ptitle, seat_location = :sloc,
          cgi_submit_dt = :dsub, num_resource_need = :numres, proj_start_dt = :pstart,
          tmfp = :TMFP, job_type = :type, est_resource_start_dt = :rsdate,
          est_resource_end_dt = :rendate, proj_client = :proj_client, confidence = :conf_perc,
          hiring_manager = :hir_manag, senior_manager = :sen_manag, cgi_engage_manager = :engag_manag,
          proj_code = :pcode, target_salary = :t_salary, rate_crd_cat_lvl = :rcc_level,
          position_desc = :posit_desc, recommended_hiring = :rec_hire,
          notes = notes + :notes, so_number = :soNum, comments = :comments,
          status = :status, rej_opt = :rej_opt, rej_reason = :rej_reason WHERE RM_ID = '$id'";
  $stmt = $con->prepare($sql);
  $stmt->execute(array(
    ':ptitle' => $_POST['ptitle'],
    ':sloc' => $_POST['sloc'],
    ':dsub' => date("Y-m-d", strtotime($_POST['dsub'])),
    ':numres' => $_POST['numres'],
    ':pstart' => date("Y-m-d", strtotime($_POST['pstart'])),
    ':TMFP' => $_POST['TMFP'],
    ':type' => $_POST['type'],
    ':rsdate' => date("Y-m-d", strtotime($_POST['rsdate'])),
    ':rendate' => date("Y-m-d", strtotime($_POST['rendate'])),
    ':proj_client' => $_POST['proj_client'],
    ':conf_perc' => $_POST['conf_perc'],
    ':hir_manag' => $_POST['hir_manag'],
    ':sen_manag' => $_POST['sen_manag'],
    ':engag_manag' => $_POST['engag_manag'],
    ':pcode' => $_POST['pcode'],
    ':t_salary' => $_POST['t_salary'],
    ':rcc_level' => $_POST['rcc_level'],
    ':posit_desc' => $_POST['posit_desc'],
    ':rec_hire' => $_POST['rec_hire'],
    ':notes' => $_POST['notes'],
    ':soNum' => $_POST['soNum'],
    ':comments' => $_POST['comments'],
    ':status' => $_POST['status'],
    ':rej_opt' => $_POST['rej_opt'],
    ':rej_reason' => $_POST['rej_reason']
  ));
  $correct = true;
  echo "Form Updated Successfully <br/> <a href='hrHome.php'>Home</a><br/><a href='../email.php'.>E-mail</a><br/><a href='../logout.php'>Logout</a>";
}catch(PDOException $e) {
  $correct = false;
  echo $e->getMessage();
  }
}
}
}
?>
