<?php /**
* @package r_bot
* @author Jonathan Fignole <jonathan.fignole@cgi.com>
* @author Tyler Patrick Steve <tyler.p.steve@cgi.com>
* @copyright  2017 CGI Group Inc.
*/
session_start();
if(!isset($_SESSION['emp'])){#If session is not set, user isn't logged in.
    #Redirect to Login Page
    header("Location:../logout.php");
    exit();
}
// DB -> php config file
include("../config.php");
$id = $_GET['id'];#Gets id from previous page and queries the database to get
#information to fill in this particular RM_FORM
$conn=new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD); #DB Connection
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);#Sets PDO error types
$sql = "SELECT * FROM templates WHERE ID = '$id'";
$stmt = $conn->prepare($sql);
$stmt->execute();#Builds and runs query
$rowt = $stmt->fetchAll(PDO::FETCH_ASSOC);#Fetches query into array with column
#names instead of indexes
if( !(isset( $_POST['submit'] ) ) ) { ?>
<!-- Begin HTML -->
  <!DOCTYPE html>
  <html>
  <header>
    <center><img src="/images/banner_main.png" alt="Banner"><center>
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
      <form method="POST" action="">
        <tr>
          <th class='EMP'><b>POSITION TITLE</b></th>
          <th class='EMP'><b>SEAT LOCATION</b></th>
          <th class='EMP'><b>DATE SUBMITTED TO CGI</b></th>
        </tr>
        <tr>
          <td>
            <input type="text" value="<?php echo $rowt[0]['position_title']?>" name="ptitle">
            </output>
          </td>
          <td>
            <input name="sloc" type="text">
          </td>
          <td>
            <input type="date" id="clndr1" placeholder="mm/dd/yyyy" name="dsub">
            <script> 
              jQuery(function($){ //on document.ready
              $('#clndr1').datepicker();
              }) 
            </script>
          </td>
        </tr>
        <tr>
          <th class='EMP'><b># OF RESOURCES NEEDED</b></th>
          <th class='EMP'><b>PROJECT START DATE</b></th>
          <th class='EMP'><b>FIXED PRICE OR TM</b></th>
        </tr>
        <tr>
          <td>
            <input type="number" min="0" name="numres" placeholder="0">
          </td>
          <td>
            <input type="date" id="clndr2" placeholder="mm/dd/yyyy" name="pstart">
            <script> 
              jQuery(function($){ //on document.ready
              $('#clndr2').datepicker();
              }) 
            </script>
          </td>
          <td>
            <select name="TMFP">
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
          <td>
            <select name="type">
              <option value="Development">Development</option>
              <option value="Testing">Testing</option>
              <option value="Support">Support</option>
              <option value="Consulting">Consulting</option>
            </select>
          </td>
          </select>
          </td>
          <td>
            <input type="date" id="clndr3" placeholder="mm/dd/yyyy" name="rsdate">
            <script> 
              jQuery(function($){ //on document.ready
              $('#clndr3').datepicker();
              }) 
            </script>
          </td>
          <td>
            <input type="date" id="clndr4" placeholder="mm/dd/yyyy" name="rendate">
            <script> 
              jQuery(function($){ //on document.ready
              $('#clndr4').datepicker();
              }) 
            </script>
          </td>
        </tr>
        <tr>
          <th class='EMP'><b>RECOMMENDED HIRING</b></th>
          <th class='EMP'><b>PROJECT/CLIENT</b></th>
          <th class='EMP'><b>CONFIDENCE (0-100%)</b></th>
        </tr>
        <tr>
          <td>
            <select name="rec_hire">
              <option value="Direct">Direct</option>
              <option value="Temp to Perm">Temp to Perm</option>
              <option value="Contractor">Contractor</option>
            </select>
          </td>
          <td>
            <input type="text" name="proj_client">
          </td>
          <td>
            <input type="number" name="conf_perc" min="0" max="100">
          </td>
        </tr>
        <tr>
        </tr>
        <tr>
          <th class='EMP'><b>HIRING MANAGER (PNC ONLY)</b></th>
          <th class='EMP'><b>CIO/SENIOR MANAGER (PNC ONLY)</b></th>
          <th class='EMP'><b>CGI ENGAGMENT MANAGER</b></th>
        </tr>
        <tr>
          <td>
            <input type="text" name="hir_manag">
          </td>
          <td>
            <input type="text" name="sen_manag">
          </td>
          <td>
            <input type="text" name="engag_manag">
          </td>
        </tr>
        <tr>
          <th class='EMP'><b>PROJECT CODE #</b></th>
          <th class='EMP'><b>TARGET SALARY</b></th>
          <th class='EMP'><b>RATE CARD-CATEGORY-LEVEL</b></th>
        </tr>
        <tr>
          <td>
            <input type="number" min="0" name="pcode" placeholder="000000000000000">
          </td>
          <td>
            <input type="number" min="0" name="t_salary" placeholder="000000">
          </td>
          <td>
            <input type="text" name="rcc_level" placeholder="Level">
          </td>
        </tr>
        <tr>
          <th class='EMP' colspan="3"><b>POSITION DESCRIPTION</b></th>
        </tr>
        <tr>
          <td colspan="3">
            <textarea id="Position Requirements" name="posit_desc" rows="8" cols="150" palceholder="Requirements and Responsibilities" class="input">
              <?php echo $rowt[0]['position_desc']?>
            </textarea>
          </td>
        </tr>
        <tr>
          <th class='EMP' colspan="3" class='EMP'><b>COMMENTS: </b></th>
        </tr>
        <td colspan="3">
          <textarea name="comments" rows="4" cols="150" placeholder="Comments" class="input"></textarea>
        </td>
        </tr>
        <tr>
          <th class='EMP' colspan="2"><b>NOTES (Internal Only):</b></th>
          <th class='EMP'><b>STATUS</b></th>
        </tr>
        <tr>
          <td colspan="2">
            <textarea id="Notes" name="notes" rows="4" cols="105" placeholder="Notes" class="input"></textarea>
            <td>
              <select name="status">
                <option value="WAITING FOR SO_NUM">Waiting for SO_Number</option>
              </select>
            </td>
          </td>
        </tr>
        <tr>
          <td colspan="3">
            <input type="submit" value="Submit" name="submit">
            <input type="reset" value="Reset" name="reset" class="res">
          </td>
      </form>
      </tr>
    </table>
   </body>
  </html>
<?php
// error handling
    } else {
        $form = new rmClass;
        $form->storeFormValues($_POST);
        echo $form->processForm($_POST);#stores new RM_FORM in the database
    }
?>