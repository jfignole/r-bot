<?php
class vendors {
  public $name = null;
  public $p_num = null;
  public $bc_time = null;
  public $v_status = null;
  public $it_exp = null;
  public $rel_exp = null;
  public $description = null;
  public $id = null;
  public $so_number = null;

  public function __construct($data = array()){
    if(isset($data['name'])) $this->name = stripslashes(strip_tags($data['name']));
    if(isset($data['p_num'])) $this->p_num = stripslashes(strip_tags($data['p_num']));
    if(isset($data['bc_time'])) $this->bc_time = stripslashes(strip_tags($data['bc_time']));
    if(isset($data['v_status'])) $this->v_status = stripslashes(strip_tags($data['v_status']));
    if(isset($data['it_exp'])) $this->it_exp = stripslashes(strip_tags($data['it_exp']));
    if(isset($data['rel_exp'])) $this->rel_exp = stripslashes(strip_tags($data['rel_exp']));
    if(isset($data['description'])) $this->description = stripslashes(strip_tags($data['description']));
    if(isset($data['V_ID'])) $this->V_ID = stripslashes(strip_tags($data['id']));
    if(isset($data['so_number'])) $this->so_number = stripslashes(strip_tags($data['so_number']));
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
          $sql = "INSERT INTO vendor(name, phone_number, best_call_time,
            description, visa_status, it_exp, relevant_exp, so_number) VALUES(:name,
              :p_num, :bc_time, :description, :v_status, :it_exp, :rel_exp, :so_number)";
          $stmt = $con->prepare($sql);
          $stmt->bindValue("name", $this->name, PDO::PARAM_STR);
          $stmt->bindValue("p_num", $this->p_num, PDO::PARAM_STR);
          $stmt->bindValue("bc_time", $this->bc_time, PDO::PARAM_STR);
          $stmt->bindValue("v_status", $this->v_status, PDO::PARAM_STR);
          $stmt->bindValue("it_exp", $this->it_exp, PDO::PARAM_STR);
          $stmt->bindValue("rel_exp", $this->rel_exp, PDO::PARAM_STR);
          $stmt->bindValue("description", $this->description, PDO::PARAM_STR);
          $stmt->bindValue("so_number", $this->so_number, PDO::PARAM_STR);
          $stmt->execute();
          return "Entry Successful <br/> <a href='vendorHome.php'>Home</a><br/><a href='../email.php'.>E-mail</a></br><a href='../logout.php'>Logout</a>";
        }catch(PDOException $e) {
          return $e->getMessage();
        }
    }

  public static function fillForm($rowt) {
    $successt = false;
    try{
      $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sqlt = "SELECT * FROM vendor";
      $stmtt = $conn->prepare($sqlt);
      $stmtt->execute();
      $rowt = $stmtt->fetchAll(PDO::FETCH_NUM&PDO::FETCH_ASSOC);

      return $rowt;
    }catch (PDOException $et) {
      echo $et->getMessage();
      return $successt;
    }
    }

  }

 ?>
