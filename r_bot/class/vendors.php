<?php

class vendors {
  public $username = null;
  public $password = null;


  public function __construct($data = array()){
    if(isset($data['first_name'])) $this->first_name = stripslashes(strip_tags($data['first_name']));
    if(isset($data['last_name'])) $this->last_name = stripslashes(strip_tags($data['last_name']));
    if(isset($data['emp_id'])) $this->emp_id = stripslashes(strip_tags($data['emp_id']));
  }
  //Get the $_POST data from the forms and give it to the __construct method
  public function storeFormValues($params) {
    //Store the parameters
    $this->__construct($params);
  }
  public function register() {
    $correct = false;
    try {
          $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
          $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sql = "INSERT INTO vendor(first_name, last_name, emp_id) VALUES(:first_name, :last_name, :emp_id)";

          $stmt = $con->prepare($sql);
          $stmt->bindValue("first_name", $this->first_name, PDO::PARAM_STR);
          $stmt->bindValue("last_name", $this->last_name, PDO::PARAM_STR);
          $stmt->bindValue("emp_id", $this->emp_id, PDO::PARAM_STR);
          $stmt->execute();
          return "Entry Successful <br/> <a href='vendorHome.php'>Home</a>";
        }catch(PDOException $e) {
          return $e->getMmessage();
        }
    }

  }

 ?>
