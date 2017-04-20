<?php
/**
* @package r_bot
* @version 1.0
* @author Jonathan Fignole <jonathan.fignole@cgi.com>
* @copyright  2017 CGI Group Inc.
*/
class vendors {
  /**
  * Vendors class page allows interaction with the vendor table in the database.
  *
  * @package r_bot
  */
  /**
  * @var string  name from the database and completed HTML Form
  */
  public $name = null;
  /**
  * @var string  phone_number from the database and completed HTML Form
  */
  public $p_num = null;
  /**
  * @var string  best_call_time from the database and completed HTML Form
  */
  public $bc_time = null;
  /**
  * @var string  visa_status from the database and completed HTML Form
  */
  public $v_status = null;
  /**
  * @var string  it_exp from the database and completed HTML Form
  */
  public $it_exp = null;
  /**
  * @var string  relevant_exp from the database and completed HTML Form
  */
  public $rel_exp = null;
  /**
  * @var string  description from the database and completed HTML Form
  */
  public $description = null;
  /**
  * @var string  V_ID from the database
  */
  public $id = null;
  /**
  * @var string  so_number from the database
  */
  public $so_number = null;
  /**
  * Sets the object's properties using the values in the supplied array
  *
  * @param assoc The property values
  */
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
  /**
  * Sets the object's properties using the edit form post values in the supplied array
  *
  *@param assoc The form post values
  */
  public function storeFormValues($params) {
    //Store the parameters
    $this->__construct($params);
  }
  /**
  * Inserts vendor application into the database.
  *
  * @throws PDOException if the PDO doesn't exist or config.php isn't included
  * @return Form submission confirmation
  */
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
    /**
    * Fills empty RM_Form with selection from the database.
    *
    * @param mixed $rowt Rowt is the array that will be constructed in the __construct method
    * @throws PDOException if the PDO doesn't exist or config.php isn't included
    * @return Array that is used to fill in empty vendor form
    */
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

    public static function soCount($rowt) {
      $successt = false;
      try{
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sqlt = "SELECT so_number, count(*) FROM vendor GROUP BY so_number ORDER BY so_number";
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
