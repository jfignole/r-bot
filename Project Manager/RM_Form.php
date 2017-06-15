<?php /**
* @package r_bot
* @author Jonathan Fignole <jonathan.fignole@cgi.com>
* @author Tyler Patrick Steve <tyler.p.steve@cgi.com>
* @copyright  2017 CGI Group Inc.
*/
session_start(); // begin browser session
if(!isset($_SESSION['emp'])) #If session is not set, user isn't logged in.
#Redirect to Login Page
{
    header("Location:../logout.php");
    exit();
}
// PHP -> DB config file
include("../config.php");
// checks for submit
if(!(isset( $_POST['submit']))) { ?>
<!-- Begin HTML -->
  <!DOCTYPE html>
  <html>
  <header>
    <center><img src="/images/banner_main.png" alt="Banner">
      <center>
  </header>
  <head>
    <link rel='stylesheet' href='../styles.css' type='text/css'>
    <div class="container">
      <a href="home.php">Home</a>
      <a href="../logout.php">Logout</a>
    </div>
    <title>
      GPO RM Form
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
      <form method='POST' action=''>
        <tr>
          <th class='EMP'><b>POSITION TITLE</b></th>
          <th class='EMP'><b>SEAT LOCATION</b></th>
          <th class='EMP'><b>DATE SUBMITTED TO CGI</b></th>
        </tr>
        <tr>
          <td>
            <input type="text" placeholder="Position Title" name="ptitle">
          </td>
          <td>
            <input type="text" placeholder="Seat Location" name="sloc">
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
            <input type="number" placeholder="0" min="0" name="numres">
          </td>
          <td>
            <input type="date" id="clndr2" placeholder="mm/dd/yyyy" name="pstart" >
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
            <input type="number" name="conf_perc">
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
            <input type="text" placeholder="Enter Name" name="hir_manag">
          </td>
          <td>
            <input type="text" placeholder="Enter Name" name="sen_manag">
          </td>
          <td>
            <input type="text" placeholder="Enter Name" name="engag_manag">
          </td>
        </tr>
        <tr>
          <th class='EMP'><b>PROJECT CODE #</b></th>
          <th class='EMP'><b>TARGET SALARY</b></th>
          <th class='EMP'><b>RATE CARD-CATEGORY-LEVEL</b></th>
        </tr>
        <tr>
          <td>
            <input type="number" placeholder="000000000000000" min="0" name="pcode">
          </td>
          <td>
            <input type="number" placeholder="000000" min="0" name="t_salary">
          </td>
          <td>
            <input type="text" placeholder="level" name="rcc_level">
          </td>
        </tr>
        <tr>
          <th class='EMP' colspan="3"><b>POSITION DESCRIPTION</b></th>
        </tr>
        <tr>
          <td colspan="3">
            <textarea id="Position Requirements" name="posit_desc" rows="8" cols="100" placeholder="Requirements and Responsibilities" class="input"></textarea>
          </td>
        </tr>
        <tr>
          <th class='EMP' colspan="3" class='EMP'><b>COMMENTS: </b></th>
        </tr>
        <td colspan="3">
          <textarea id="Comments" name="comments" rows="4" cols="100" class="input" placeholder="Comments"></textarea>
        </td>
        </tr>
        <tr>
          <th class='EMP' colspan="2"><b>NOTES (Internal Only):</b></th>
          <th class='EMP'><b>STATUS</b></th>
        </tr>
        <tr>
          <td colspan="2">
            <textarea id="Notes" name="notes" rows="4" cols="100" placeholder="Notes" class="input"></textarea>
            <td>
              <select name="status">
                <option value="WAITING FOR SO_NUM">Waiting for SO_Number</option>
              </select>
        </tr>
        <tr>
          <td colspan="3">
            <button type="submit" name="submit" value="Submit">Send to HR</button>
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
