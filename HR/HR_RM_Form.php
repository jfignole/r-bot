<?php /**
* @package r_bot
* @author Jonathan Fignole <jonathan.fignole@cgi.com>
* @author Tyler Patrick Steve <tyler.p.steve@cgi.com>
* @copyright  2017 CGI Group Inc.
*/
session_start();
if(!isset($_SESSION['hr'])){
    header("Location:../logout.php");
    exit();
}
include("../config.php");
$id = $_GET['id'];// Gets id from previous page and queries the database to get
// information to fill in this particular RM_FORM
$conn=new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD); // DB Connection
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);// Sets PDO error types
$sql = "SELECT * FROM rmemform WHERE RM_ID = '$id'";
$stmt = $conn->prepare($sql);
$stmt->execute();// Builds and runs query
$rowt = $stmt->fetchAll(PDO::FETCH_ASSOC);// Fetches query into array with column
// names instead of indexes
if(!(isset($_POST['submit']))) { ?>
  <!DOCTYPE html>
  <html>
  <header>
    <center><img src="/images/banner_main.png" alt="Banner">
      <center>
  </header>
  <head>
    <link rel='stylesheet' href='../styles.css' type='text/css'>
    <div class="container">
      <a href="hrHome.php">Home</a>
      <a href="../logout.php">Logout</a>
    </div>
    <title>
      HR_RM_FORM
    </title>
  </head>
  <body class="hnr">
    <table>
      <form method="POST" action="">
         <tr colspan="3" class='EMP'>
          <th colspan="3" class='EMP'><b>ID NUMBER:</b></th>
        </tr>
        <tr>
          <td colspan="3"><input type="text" name="idnum" value="<?php echo $id?>"></td>
        </tr>
        <tr colspan="3" class='EMP'>
          <th class='EMP' colspan="3"><b>SO NUMBER:</b></th>
        </tr>
        <tr>
          <td colspan = "3"><input id="SoIn" required type="text" placeholder="SO Number" name="soNum" value="<?php echo $rowt[0]['so_number']?>"></td>
        </tr>
        <tr>
          <th class='HR'><b>POSITION TITLE</b></th>
          <th class='HR'><b>SEAT LOCATION</b></th>
          <th class='HR'><b>DATE SUBMITTED TO CGI</b></th>
        </tr>
        <tr>
          <td>
            <input type="text" value="<?php echo $rowt[0]['position_title']?>" name="ptitle">
            </output>
          </td>
          <td>
            <input name="sloc" type="text" value="<?php echo $rowt[0]['seat_location']?>">
          </td>
          <td>
            <input type="date" value="<?php echo $rowt[0]['cgi_submit_dt']?>" name="dsub">
          </td>
        </tr>
        <tr>
          <th class='HR'><b># OF RESOURCES NEEDED</b></th>
          <th class='HR'><b>PROJECT START DATE</b></th>
          <th class='HR'><b>FIXED PRICE OR TM</b></th>
        </tr>
        <tr>
          <td>
            <input type="text" value="<?php echo $rowt[0]['num_resource_need']?>" min="0" name="numres">
          </td>
          <td>
            <input type="date" value="<?php echo $rowt[0]['proj_start_dt']?>" name="pstart">
          </td>
          <td>
            <select name="TMFP">
              <option value="TM" <?php if($rowt[0][ 'tmfp']=="TM" ) echo "selected='selected'";?>>TM</option>
              <option value="FP" <?php if($rowt[0][ 'tmfp']=="FP" ) echo "selected='selected'";?>>FP</option>
            </select>
          </td>
        </tr>
        <tr>
          <th class='HR'><b>TYPE</b></th>
          <th class='HR'><b>ESTIMATED RESOURCE START DATE</b></th>
          <th class='HR'><b>ESTIMATED END DATE</b></th>
        </tr>
        <tr>
          <td>
            <select name="type">
              <option value="Development" <?php if($rowt[0][ 'job_type']=="Development" ) echo "selected='selected'";?> >Development</option>
              <option value="Testing" <?php if($rowt[0][ 'job_type']=="Testing" ) echo "selected='selected'";?>>Testing</option>
              <option value="Support" <?php if($rowt[0][ 'job_type']=="Support" ) echo "selected='selected'";?>>Support</option>
              <option value="Consulting" <?php if($rowt[0][ 'job_type']=="Consulting" ) echo "selected='selected'";?>>Consulting</option>
            </select>
          </td>
          </select>
          </td>
          <td>
            <input type="date" value="<?php echo $rowt[0]['est_resource_start_dt']?>" name="rsdate">
          </td>
          <td>
            <input type="date" value="<?php echo $rowt[0]['est_resource_end_dt']?>" name="rendate">
          </td>
        </tr>
        <tr>
          <th class='HR'><b>RECOMMENDED HIRING</b></th>
          <th class='HR'><b>PROJECT/CLIENT</b></th>
          <th class='HR'><b>CONFIDENCE (0-100%)</b></th>
        </tr>
        <tr>
          <td>
            <select name="rec_hire">
              <option value="Direct" <?php if($rowt[0][ 'recommended_hiring']=="Direct" ) echo "selected='selected'";?>>Direct</option>
              <option value="Temp to Perm" <?php if($rowt[0][ 'recommended_hiring']=="Temp to Perm" ) echo "selected='selected'";?>>Temp to Perm</option>
              <option value="Contractor" <?php if($rowt[0][ 'recommended_hiring']=="Contractor" ) echo "selected='selected'";?>>Contractor</option>
            </select>
          </td>
          <td>
            <input type="text" name="proj_client" value="<?php echo $rowt[0]['proj_client']?>">
          </td>
          <td>
            <input type="text" name="conf_perc" value="<?php echo $rowt[0]['confidence']?>" min="0" max="100">
          </td>
        </tr>
        <tr>
        </tr>
        <tr>
          <th class='HR'><b>HIRING MANAGER (PNC ONLY)</b></th>
          <th class='HR'><b>CIO/SENIOR MANAGER (PNC ONLY)</b></th>
          <th class='HR'><b>CGI ENGAGMENT MANAGER</b></th>
        </tr>
        <tr>
          <td>
            <input type="text" value="<?php echo $rowt[0]['hiring_manager']?>" name="hir_manag">
          </td>
          <td>
            <input type="text" value="<?php echo $rowt[0]['senior_manager']?>" name="sen_manag">
          </td>
          <td>
            <input type="text" value="<?php echo $rowt[0]['cgi_engage_manager']?>" name="engag_manag">
          </td>
        </tr>
        <tr>
          <th class='HR'><b>PROJECT CODE # </b></th>
          <th class='HR'><b>TARGET SALARY</b></th>
          <th class='HR'><b>RATE CARD-CATEGORY-LEVEL</b></th>
        </tr>
        <tr>
          <td>
            <input type="text" value="<?php echo $rowt[0]['proj_code']?>" min="0" name="pcode">
          </td>
          <td>
            <input type="text" value="<?php echo $rowt[0]['target_salary']?>" min="0" name="t_salary">
          </td>
          <td>
            <input type="text" value="<?php echo $rowt[0]['rate_crd_cat_lvl']?>" name="rcc_level">
          </td>
        </tr>
        <tr>
          <th class='HR' colspan="3"><b>POSITION DESCRIPTION</b></th>
        </tr>
        <tr>
          <td colspan="3">
            <textarea id="Position Requirements" name="posit_desc" rows="8" cols="100" class="input"><?php echo $rowt[0]['position_desc']?></textarea>
          </td>
        </tr>
        <tr>
          <th class='EMP' colspan="3" class='EMP'><b>COMMENTS: </b></th>
        </tr>
        <td colspan="3">
          <textarea id="Comments" name="comments" rows="4" cols="100" class="input"><?php echo $rowt[0]['comments']?></textarea>
        </td>
        </tr>
        <tr>
          <th class='HR'><b>STATUS</b></th>
          <th class='HR' colspan="2"><b>NOTES (Internal Only):</b></th>
        </tr>
        <tr>
          <td>
            <select name="status">
              <option value="WAITING FOR VENDOR RESPONSE" <?php if($rowt[0][ 'status']=="WAITING FOR VENDOR RESPONSE" ) echo "selected='selected'";?>>SN Applied, Sent to Vendor</option>
              <option value="REJECTED" <?php if($rowt[0][ 'status']=="REJECTED" ) echo "selected='selected'";?>>REJECTED</option>
            </select>
          <td colspan="2">
          <textarea id="Notes" name="notes" rows="5" cols="100" class="input"><?php echo $rowt[0]['notes']?></textarea>
        </tr>
        <tr>
          <th class='HR'><b>REJECT</b></th>
          <th colspan="2" class="HR"><b>REASON FOR REJECTION</b></th>
        </tr>
        <tr>
          <td>
            <select id="SelectBox" name="rej_opt" required>
              <option value="NO">NO</option>
              <option value="YES">YES</option>
          </td>
          <td colspan="2">
            <textarea id="textarea" type="text" name="rej_reason" rows="4" cols="60"></textarea>
          </td>
        </tr>
        <tr>
          <td colspan="3">
            <input type="submit" name="submit" value="Submit Form">
            <input type="reset" value="Reset" name="reset" class="res">
          </td>
          </td>
        </tr>
      </form>
    </table>
    <!-- JS below to make rejected text area REQUIRED if yes is selected for the reject option -->
    <script>
      var select = document.getElementById("SelectBox");
        var textareaElement = document.getElementById("SoIn");
        select.onchange = function(){
            var selectedString = select.options[select.selectedIndex].value;
            if(selectedString == 'NO'){
              textareaElement.required = true;
              textareaElement.style.border="1px solid red";
            }else{
            textareaElement.required = false;
            textareaElement.style.border="";
            }
        }
    </script>
  </body>
  </html>
<?php
  } else {
      try{
          $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD); // sets DB username and password
          $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	  //, rej_opt = :rej_opt, rej_reason = :rej_reason & ':rej_reason' => $_POST['rej_reason'] // rej_reason = rej_reason
          // SQL below to set each value to a attribute value for update on $id
          $sql = "UPDATE rmemform SET position_title = :ptitle, seat_location = :sloc,
          cgi_submit_dt = :dsub, num_resource_need = :numres, proj_start_dt = :pstart,
          tmfp = :TMFP, job_type = :type, est_resource_start_dt = :rsdate,
          est_resource_end_dt = :rendate, proj_client = :proj_client, confidence = :conf_perc,
          hiring_manager = :hir_manag, senior_manager = :sen_manag, cgi_engage_manager = :engag_manag,
          proj_code = :pcode, target_salary = :t_salary, rate_crd_cat_lvl = :rcc_level,
          position_desc = :posit_desc, recommended_hiring = :rec_hire,
          notes = :notes, so_number = :soNum, comments = :comments,
          status = :status, rej_opt = :rej_opt, rej_reason = :rej_reason WHERE RM_ID = '$id'";
          $stmt = $con->prepare($sql); // prepare the SQL stateement
          // execute the SQL
          $stmt->execute(array(
          ':ptitle' => $_POST['ptitle'], // position_title = ptitle
          ':sloc' => $_POST['sloc'], // seat_location = sloc
          ':dsub' => date("Y-m-d", strtotime($_POST['dsub'])), // date_submitted = dsub
           ':numres' => $_POST['numres'], // num_resource_need = numres
          ':pstart' => date("Y-m-d", strtotime($_POST['pstart'])), // position_start_date = pstart
          ':TMFP' => $_POST['TMFP'], // TMFP = TMFP
          ':type' => $_POST['type'], // job_type = type
          ':rsdate' => date("Y-m-d", strtotime($_POST['rsdate'])), // resource_start_date = rsdate
          ':rendate' => date("Y-m-d", strtotime($_POST['rendate'])), // est_resource_start_date = rendate
          ':proj_client' => $_POST['proj_client'], // project_client = proj_client
          ':conf_perc' => $_POST['conf_perc'], // confidence_percentage = conf_perc
          ':hir_manag' => $_POST['hir_manag'], // hiring_manager = hir_manag
          ':sen_manag' => $_POST['sen_manag'], // senior_manager = sen_mang
          ':engag_manag' => $_POST['engag_manag'], // engagement_manager = engag_manag
          ':pcode' => $_POST['pcode'], // project_code = pcode
          ':t_salary' => $_POST['t_salary'], // target_salary = t_salary
          ':rcc_level' => $_POST['rcc_level'], // rate_crd_car_lvl = rcc_level
          ':posit_desc' => $_POST['posit_desc'], // position_description = posit_desc
          ':rec_hire' => $_POST['rec_hire'], // recommended_hiring = rec_hire
          ':notes' => $_POST['notes'], // notes = notes
          ':soNum' => $_POST['soNum'], // so_number = soNum
          ':comments' => $_POST['comments'], // comments = comments
          ':status' => $_POST['status'], // status = status
          ':rej_opt' => $_POST['rej_opt'],// rejection_option = rej_opt
	  ':rej_reason' => $_POST['rej_reason'] 
          ));
          // JS below to alert window and redirect
          echo "<script type=\"text/javascript\">
            if (window.confirm('Form has been submitted'))
            {
                window.location = 'hrHome.php'
            }else{
                window.location = 'hrHome.php'
            }
            </script> ";
      // error exception
      }catch(PDOException $e) {
          $correct = false;
          echo $e->getMessage();
      }
    }
?>