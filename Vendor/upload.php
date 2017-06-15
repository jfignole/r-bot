<?php if(isset($_POST['btn-upload']))
    {
      $file = $_FILES['pdfFile']['name'];
      $tmp_dir = $_FILES['pdfFile']['tmp_name'];
      $fileSize = $_FILES['pdfFile']['size'];
      if(empty($file)){
        $errMSG = "Please Select a File";
      }
      else {
        $folder="../uploads/"; //upload Directory
        $filExt = strtolower(pathinfo($file,PATHINFO_EXTENSION)); //get file extension
        $val_ext = array('pdf', 'doc', 'docx'); //valid file extensions
        //allow valid file formats
        if(in_array($filExt, $val_ext)){
          //check File size '1MB'
          if($fileSize < 1000000) {
            try{
              if(!move_uploaded_file($tmp_dir,$folder.$file)){
                throw new Exception('Could not move file');
              }
          }catch(Exception $e) {
             echo'File did not upload: '  .$_FILES["pdfFile"]["error"];
          }
        }
          else{
            $errMSG = "Sorry, your file is too large.";
          }
        }
        else{
          $errMSG = "Sorry, only PDF, DOC & DOCX files are allowed.";
        }
      }
      //if no error occured, continue...
      if(!isset($errMSG))
      {
        $id = $rowt[0]['so_number'];
        $query = $conn->prepare('INSERT INTO files (fileName, fileActual, file_type,
		file_size, so_number) VALUES (:fName, :fActual, :fType, :fSize, :so_number)');
        $query->bindParam(':fName',$file);
        $query->bindParam(':fActual',$newFile);
        $query->bindParam(':fType',$filExt);
        $query->bindParam(':fSize',$fileSize);
        $query->bindParam('so_number', $id);
        if($query->execute())
        {
          $successMSG = "{$file} successfully Added";
          echo "<script language='javascript'>";
          echo "var msg = '$successMSG';";
          echo "alert(msg)";
          echo "</script>"; 
        }
        else {
          $errMSG = "error while uploading....";
        }
      }
    }
?>