email.php [
<?php
echo "<link rel='stylesheet' href='styles.css' type='text/css' />";
echo "<ul><li><a href='mailto:HR@example.org';'>Email HR</a></li>";
echo "<li><a href='mailto:Vendor@example.org';'>Email Vendor</a> </li>";
echo "<li><a href='mailto:Employee@example.org';'>Email Employee</a> </li>";
echo "<li><a href='mailto:HR@example.org; Vendor@example.org';'>Email Vendor and HR</a> </li>";
echo "<li><a href='logout.php'>Logout</a></li>";
?>


<?php

//if "email" variable is filled out, send email
  if (isset($_POST['email']))  {

      try {
          $message = new Message($mail_options);
          $message->send();
      } catch (InvalidArgumentException $e) {

      }

      //Email information
      $from = $_POST['from'];
      $to = $_POST['to'];
      $subject = $_POST['subject'];
      $message = $_POST['message'];
      $message = wordwrap($message, 80, "\r\n");
      //send email
      mail($to, "$subject", $message, "From:" . $from);

      //Email response

      echo "Thank you for contacting us!";

        //if "email" variable is not filled out, display the form

    } else { ?>
    <!DOCTYPE html>
    <html>
    <head>
    <meta charset="utf-8">
    <title>Home</title>
    <link rel="stylesheet" href="styles.css" type="text/css" />
    </head>
    <h1>CGI</h1>
    <h2>R-BOT</h2>
    <body>
      <table>
     <form class="email" method="post">
       <tr><th>To: </th></tr>
       <tr><td><input name="to" type="text" /></td></tr>
       <tr><th>From: </th></tr>
       <tr><td><input name="from" type="text" ></td></tr>
       <tr><th>Subject: </th></tr>
       <tr><td><input name="subject" type="text" /></td></tr>
       <tr><th>Message:</th></tr>
       <tr><td><textarea name="message" rows="15" cols="40"></textarea></td></tr>
       <tr><td><input type="submit" value="Submit" style="float: right"/></td></tr>
      </form>
    </table>
    </body>
    </html>
    <?php
      }


?>
]

rmClass.php [<?php
function updateForm() {
  $correct = false;
  try {
    $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE rmemform SET position_title = :ptitle, seat_location = :sloc, cgi_submit_dt = :dsub,
      num_resource_need = :numres, proj_start_dt = :pstart, tmfp = :TMFP, job_type = :type, est_resource_start_dt = :rsdate,
      est_resource_end_dt = :rendate, proj_client = :proj_client, confidence = :conf_perc, hiring_manager = :hir_manag, senior_manager = :sen_manag,
      cgi_engage_manager = :engag_manag, proj_code = :pcode, target_salary = :t_salary, rate_crd_cat_lvl = :rcc_level, position_desc = :posit_desc,
      recommended_hiring = :rec_hire, notes = :notes, so_number = :soNum, comments = :comments WHERE RM_ID = '$id'";


    $stmt = $con->prepare($sql);
    $stmt->execute(array(
      ':ptitle' =>$_POST['ptitle'],
      ':sloc' =>$_POST['sloc'],
      ':dsub' =>date("Y-m-d", strtotime($_POST['dsub'])),
      ':numres' =>$_POST['numres'],
      ':pstart' =>date("Y-m-d", strtotime($_POST['pstart'])),
      ':TMFP' =>$_POST['TMFP'],
      ':type' =>$_POST['type'],
      ':rsdate' =>date("Y-m-d", strtotime($_POST['rsdate'])),
      ':rendate' =>date("Y-m-d", strtotime($_POST['rendate'])),
      ':proj_client' =>$_POST['proj_client'],
      ':conf_perc' =>$_POST['conf_perc'],
      ':hir_manag' =>$_POST['hir_manag'],
      ':sen_manag' =>$_POST['sen_manag'],
      ':engag_manag' =>$_POST['engag_manag'],
      ':pcode' =>$_POST['pcode'],
      ':t_salary' =>$_POST['t_salary'],
      ':rcc_level' =>$_POST['rcc_level'],
      ':posit_desc' =>$_POST['posit_desc'],
      ':rec_hire' =>$_POST['rec_hire'],
      ':notes' =>$_POST['notes'],
      ':soNum' =>$_POST['soNum'],
      ':comments' =>$_POST['comments']
    ));
    $correct = true;
    return "Form Updated Successfully <br/> <a href='hrHome.php'>Home</a>";
  }catch(PDOException $e) {
    $correct = false;
    return $e->getMessage();
  }
}
//]

//HR_AP_RM_Form.php [
$form = new rmClass;
$form->storeFormValues($_POST);
echo $form->updateEmForm($_POST);#updates RM_FORM in the database
//]

//mailTest.php [
//s<?php
$to       = 'jonathan.fignole@gmail.com';
$subject  = 'Testing sendmail.exe';
$message  = 'Hi, you just received an email using sendmail!';
$headers  = 'From: jbfignole@gmail.com' . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=utf-8';

if(mail($to, $subject, $message, $headers))
    echo "Email sent";
else
    echo "Email sending failed";
?>

<?php
$to       = 'jonathan.fignole@gmail.com';
$subject  = 'Testing sendmail.exe';
$message  = 'Hi, you just received an email using sendmail!';
$headers  = 'From: jbfignole@gmail.com' . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=utf-8';

try{if(mail('jonathan.fignole@gmail.com', 'hope this works', 'did it work?', $headers)){
    echo "Email sent";
  }else{

  {
    echo "Email sending failed";
    echo $e->getMessage();
  }}}catch(PDOException $e){
    echo $e->getMessage();
  }



//]

//upload.php Lines 47 - 50 [
$stmt->bindParam(':file', $dest_file, PDO::PARAM_STR);
$stmt->bindParam(':data', $file_data, PDO::PARAM_STR);
$stmt->bindParam(':type', $file_type, PDO::PARAM_STR);
$stmt->bindParam(':size', $file_size, PDO::PARAM_INT);
//]



//vendors.php [
//public static
function singleForm($id) {
  $conn=new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "SELECT * FROM vendor WHERE V_ID = :id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam("id", $id, PDO::PARAM_INT);
  $stmt->execute(array(':id' => $id));
  $rowt = $stmt->fetch(PDO::FETCH_ASSOC);
  return $rowt;
}


//public static
 function arrayIterator($rowt) {

}
//]

//vendorCVUpload.php [
if ($handle = opendir('../upload/')) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            echo "$entry<br>";
        }
    }
    closedir($handle);
}
?>

<td>File Type</td>
<td>File Size(KB)</td>
<th>View</th>
<td><?php echo $rowt[$i]['file_type']; ?></td>
    <td><?php echo $rowt[$i]['file_size']; ?></td>
    <td><a href='uploaded_files/<?php echo $rowt[$i]["fileActual"]; ?>' target="_blank">view file</a></td>





<!--]upload.php [-->
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="styles.css"/>
  </head>
  <body>
    <h1>CGI</h1>
    <h2>R-Bot</h2>
  </body>
</html>

<?php
include("config.php");
if ( isset( $_FILES['pdfFile'] ) ) {
  if ($_FILES['pdfFile']['type'] == "application/pdf")
   {
    $source_file = $_FILES['pdfFile']['tmp_name'];
    $dest_file = "upload/".$_FILES['pdfFile']['name'];
    var_dump($_FILES);
    if (file_exists($dest_file)) {
      print "The file name already exists!!";
        echo "<a href='/r_bot/Vendor/vendorHome.php'>Back</a>";
    }
    else {
      move_uploaded_file( $source_file, $dest_file )
      or die ("Error!!");
      if($_FILES['pdfFile']['error'] == 0) {
        print "CV uploaded successfully!";
        print "<b><u>Details : </u></b><br/>";
        print "File Name : ".$_FILES['pdfFile']['name']."<br.>"."<br/>";
        print "File Size : ".$_FILES['pdfFile']['size']." bytes"."<br/>";
        print "File location : upload/".$_FILES['pdfFile']['name']."<br/>";
        $file_data = file_get_contents($dest_file);
        $file_info = finfo_open(FILEINFO_MIME_TYPE);
        $file_type = finfo_file($file_info, $dest_file);
        $file_size = filesize($dest_file);
        echo $dest_file."<br>";
        echo $file_type."<br>";
        echo $file_size."<br>";
        echo $file_data."<br>";
        try {
        $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO files (fileName, fileActual, file_type, file_size)
         VALUES ('$dest_file', '$file_data' '$file_type', '$file_size')";
        $stmt = $con->prepare($sql);
        $stmt->execute();
      }catch(PDOException $e) {
        echo "Upload did not work!";
        echo $e->getMessage();
      }
          echo "<a href='/r_bot/Vendor/rm_request_list.php'>Back</a>";
      }

    }
  }
  else {
    if ($_FILES['pdfFile']['type'] != "application/pdf") {
      print "Error occured while uploading file : ".$_FILES['pdfFile']['name']."<br/>";
      print "Invalid  file extension, should be pdf or doc !!"."<br/>";
      print "Error Code : ".$_FILES['pdfFile']['error']."<br/>";
      echo "<a href='/r_bot/Vendor/rm_request_list.php'>Back</a>";
    }
  }
}
?>


<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="styles.css"/>
  </head>
  <body>
    <h1>CGI</h1>
    <h2>R-Bot</h2>
  </body>
</html>

<?php
if ( isset( $_FILES['pdfFile'] ) ) {
  if ($_FILES['pdfFile']['type'] == "application/pdf")
   {
    $source_file = $_FILES['pdfFile']['tmp_name'];
    $dest_file = "upload/".$_FILES['pdfFile']['name'];
    var_dump($_FILES);
    if (file_exists($dest_file)) {
      print "The file name already exists!!";
        echo "<a href='/r_bot/Vendor/vendorHome.php'>Back</a>";
    }
    else {
      move_uploaded_file( $source_file, $dest_file )
      or die ("Error!!");
      if($_FILES['pdfFile']['error'] == 0) {
        print "CV uploaded successfully!";
        print "<b><u>Details : </u></b><br/>";
        print "File Name : ".$_FILES['pdfFile']['name']."<br.>"."<br/>";
        print "File Size : ".$_FILES['pdfFile']['size']." bytes"."<br/>";
        print "File location : upload/".$_FILES['pdfFile']['name']."<br/>";
          echo "<a href='/r_bot/Vendor/vendorHome.php'>Back</a>";
      }
    }
  }
  else {
    if ($_FILES['pdfFile']['type'] != "application/pdf") {
      print "Error occured while uploading file : ".$_FILES['pdfFile']['name']."<br/>";
      print "Invalid  file extension, should be pdf or doc !!"."<br/>";
      print "Error Code : ".$_FILES['pdfFile']['error']."<br/>";
      echo "<a href='/r_bot/Vendor/vendorHome.php'>Back</a>";
    }
  }
}
?>

]

<!--home.php [-->

<li><a href="mailTest.php" style = "font-size:14px">Mail Test Page</a></li>
<!--]-->
