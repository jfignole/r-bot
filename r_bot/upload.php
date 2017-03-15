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
