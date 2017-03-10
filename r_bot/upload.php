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
