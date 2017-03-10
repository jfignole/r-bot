<?php
class files {
  public $description = null;
  public $filename = null;

  public function __construct($data = array()){
    if(isset($data['description'])) $this->description = stripslashes(strip_tags($data['description']));
    if(isset($data['filename'])) $this->filename = stripslashes(strip_tags($data['filename']));
  }

  //Get the $_POST data from the forms and give it to the __construct method
  public function storeFormValues($params) {
    //Store the parameters
    $this->__construct($params);
  }
  public function insertForm() {
    $correct = false;
    try {
          $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
          $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sql = "INSERT INTO files(description, filename) VALUES(:description,
              :filename)";
          $stmt = $con->prepare($sql);
          $stmt->bindValue("description", $this->description, PDO::PARAM_STR);
          $stmt->bindValue("filename", $this->filename, PDO::PARAM_STR);
          $stmt->execute();
          return "File Uploaded Successfully <br/> <a href='vendorHome.php'>Home</a>";
        }catch(PDOException $e) {
          return $e->getMessage();
        }
    }
  }
  ?>
