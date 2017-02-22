<?php
include_once("config.php");
?>

<?php if(!(isset($_POST['submit']))) { ?>

 <!DOCTYPE html>
 <html>
   <head>
      <link rel='stylesheet' href='styles.css' type="text/css">
      <title>Registration Form</title>
   </head>
   <body>
     	<h1>CGI</h1>
       <table>
       <form method='post'>
         <tr><th><b>First Name:</b></th><td><input type='text'maxlenth="30" required autofocus name="first_name"/></td></tr>
         <tr></tr>
         <tr><th><b>Last Name:</b></th><td><input type="text" maxlenth="30" required  name="last_name"/></td></tr>
         <tr></tr>
         <tr><th><b>Employee ID: </b></th><td><input type='text' maxlength="30" required name='emp_id'/></td></tr>
         <tr></tr>
         <tr><th><b>Confirm Employee ID: </b></th><td><input type='text' maxlength="30" required name='conempID'/></td></tr>
         <tr></tr>
         <tr><td colspan="2"><input type='submit' name='submit' value='Submit' />
           <input type='button' name="cancel" value="Cancel" onclick="location.href='vendorHome.php'" /></td></tr>
      </form>
    </table>
   </body>
 </html>

 <?php
 } else {
   $vndr = new Vendors;
   $vndr->storeFormValues( $_POST );

   if( $_POST['emp_id'] == $_POST['conempID'] ) {
     echo $vndr->register($_POST);
   } else {
     echo "Employee ID and Confirm employee ID do not match";
   }
 }
 ?>
