<?php /**
* @package r_bot
* Project Manager Homepage.
*
* Allows navigation to other pages that fall under Project Manager umbrella.
*
* @author Jonathan Fignole <jonathan.fignole@cgi.com>
* @author Tyler Patrick Steve <tyler.p.steve@cgi.com> 
* @copyright  2017 CGI Group Inc.
*/
# Session begin command
session_start();
if(!isset($_SESSION['emp'])) #If session is not set, user isn't logged in.
#Redirect to Login Page
{
    header("Location:../logout.php");
    exit();
}
//include_once("../header.php");
?>
  <!DOCTYPE html>
  <html>
  <div id="header">
    <!-- Banner image for every page -->
    <img src="/images/banner_main.png" alt="Banner">
  </div>
  <head>
    <meta charset="utf-8">
    <center><title>Help</title></center>
    <link rel="stylesheet" href="../styles.css" type="text/css" />
    <div class="container">
      <a href="home.php">Home</a>
      <a href="../logout.php">Logout</a>
    </div>
  </head>
  <body>
    <p><b>Link action's:</b></p>     
        <h4>Clicking a SO_NUMBER to view applications and CV's</h4>     
        <h4>Clicking a POSITION TITLE to view the RM_Form</h4>    
        <h4>Clicking an UPDATE STATUS to update the status of the RM_Form</h4>  
    <p><b>Status definitions:</b></p>    
        <h4><u>WAITING FOR SO_NUM</u> - The form has been sent to HR, and is awaiting a SO_NUMBER assignment </h4>    
        <h4><u>WAITING FOR VENDOR RESPONSE</u> - The form has been reviewed and sent to the vendors for applicants to be applied</h4>    
        <h4><u>APPLICATION RECEIVED</u> - The RM_FORM has received one or more applications for that project</h4>     
        <h4><u>RM_FORM CLOSED/ RESOURCE HIRED</u> - The form has been closed due to enough applicant or a reource has been hired for the project</h4>     
        <h4><u>REJECTED</u> - The RM_FORM has been rejected from HR</h4>
  </body>
</html>