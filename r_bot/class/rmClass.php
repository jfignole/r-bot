<?php
/**
* @package r_bot
*/
class rmClass {
  /**
  * @package r_bot
  *
  * @author Jonathan Fignole <jonathan.fignole@cgi.com>
  * @copyright  2017 CGI Group Inc.
  */

  /**
  * @var string  position_title from the database and completed HTML Form
  */
  public $ptitle = null;
  /**
  * @var string  seat_location from the database and completed HTML Form
  */
  public $sloc = null;
  /**
  * @var date  cgi_submit_dt from the database and completed HTML Form
  */
  public $dsub = null;
  /**
  * @var int  num_resource_need from the database and completed HTML Form
  */
  public $numres = null;
  /**
  * @var date  proj_start_dt from the database and completed HTML Form
  */
  public $pstart = null;
  /**
  * @var string tmfp from the database and completed HTML Form
  */
  public $TMFP = null;
  /**
  * @var string  job_type from the database and completed HTML Form
  */
  public $type = null;
  /**
  * @var date  est_resource_start_dt from the database and completed HTML Form
  */
  public $rsdate = null;
  /**
  * @var date  est_resource_end_dt from the database and completed HTML Form
  */
  public $rendate = null;
  /**
  * @var string  proj_client from the database and completed HTML Form
  */
  public $proj_client = null;
  /**
  * @var string  hiring_manager from the database and completed HTML Form
  */
  public $hir_manag = null;
  /**
  * @var string  senior_manager from the database and completed HTML Form
  */
  public $sen_manag = null;
  /**
  * @var string  cgi_engage_manager from the database and completed HTML Form
  */
  public $engag_manag = null;
  /**
  * @var int  proj_code from the database and completed HTML Form
  */
  public $pcode = null;
  /**
  * @var int  target_salary from the database and completed HTML Form
  */
  public $t_salary = null;
  /**
  * @var string  rate_crd_cat_lvl from the database and completed HTML Form
  */
  public $rcc_level = null;
  /**
  * @var string  positioon_desc from the database and completed HTML Form
  */
  public $posit_desc = null;
  /**
  * @var string  recommended_hiring from the database and completed HTML Form
  */
  public $rec_hire = null;
  /**
  * @var string  notes from the database and completed HTML Form
  */
  public $notes = null;
  /**
  * @var string  so_number from the database and completed HTML Form
  */
  public $soNum = null;
  /**
  * @var string  comments from the database and completed HTML Form
  */
  public $comments = null;
  /**
  * @var timestamp  date_submitted from the database
  */
  public $time = null;
  /**
  * @var string  status  from the database
  */
  public $status = null;

  /**
  * Sets the object's properties using the values in the supplied array
  *
  * @param assoc The property values
  */
  public function __construct($data = array()) {
    if(isset($data['ptitle'])) $this->ptitle = stripslashes(strip_tags($data['ptitle']));
    if(isset($data['sloc'])) $this->sloc = stripslashes(strip_tags($data['sloc']));
    if(isset($data['dsub'])) $this->dsub = stripslashes(strip_tags($data['dsub']));
    if(isset($data['numres'])) $this->numres = stripslashes(strip_tags($data['numres']));
    if(isset($data['pstart'])) $this->pstart = stripslashes(strip_tags($data['pstart']));
    if(isset($data['TMFP'])) $this->TMFP = stripslashes(strip_tags($data['TMFP']));
    if(isset($data['type'])) $this->type = stripslashes(strip_tags($data['type']));
    if(isset($data['rsdate'])) $this->rsdate = stripslashes(strip_tags($data['rsdate']));
    if(isset($data['rendate'])) $this->rendate = stripslashes(strip_tags($data['rendate']));
    if(isset($data['proj_client'])) $this->proj_client = stripslashes(strip_tags($data['proj_client']));
    if(isset($data['conf_perc'])) $this->conf_perc = stripslashes(strip_tags($data['conf_perc']));
    if(isset($data['hir_manag'])) $this->hir_manag = stripslashes(strip_tags($data['hir_manag']));
    if(isset($data['sen_manag'])) $this->sen_manag = stripslashes(strip_tags($data['sen_manag']));
    if(isset($data['engag_manag'])) $this->engag_manag = stripslashes(strip_tags($data['engag_manag']));
    if(isset($data['pcode'])) $this->pcode = stripslashes(strip_tags($data['pcode']));
    if(isset($data['t_salary'])) $this->t_salary = stripslashes(strip_tags($data['t_salary']));
    if(isset($data['rcc_level'])) $this->rcc_level = stripslashes(strip_tags($data['rcc_level']));
    if(isset($data['posit_desc'])) $this->posit_desc = stripslashes(strip_tags($data['posit_desc']));
    if(isset($data['rec_hire'])) $this->rec_hire = stripslashes(strip_tags($data['rec_hire']));
    if(isset($data['notes'])) $this->notes = stripslashes(strip_tags($data['notes']));
    if(isset($data['soNum'])) $this->soNum = stripslashes(strip_tags($data['soNum']));
    if(isset($data['comments'])) $this->comments = stripslashes(strip_tags($data['comments']));
    if(isset($data['status'])) $this->status = stripslashes(strip_tags($data['status']));
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
* Fills empty RM_Form with selection from the database.
*
* @param mixed $rowt Rowt is the array that will be constructed in the __construct method
* @throws PDOException if the PDO doesn't exist or config.php isn't included
* @return Array that is used to fill in empty RM_Form
*/
public static function fillForm($rowt) {
include("../config.php");
  $successt = false;
  try{
    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sqlt = "SELECT * FROM rmemform";
    $stmtt = $conn->prepare($sqlt);
    $stmtt->execute();
    $rowt = $stmtt->fetchAll(PDO::FETCH_NUM&PDO::FETCH_ASSOC);
    return $rowt;
  }catch (PDOException $et) {
    echo $et->getMessage();
    return $successt;
  }
}

/**
* Fills empty RM_Form with selection from the database.
*
* @param mixed $rowt Rowt is the array that will be constructed in the __construct method
* @throws PDOException if the PDO doesn't exist or config.php isn't included
* @return Array that is used to fill in empty RM_Form
*/
public static function appFillForm($rowt) {
include("../config.php");
  $successt = false;
  try{
    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sqlt = "SELECT * FROM rmemform WHERE status = 'APPLICATION RECEIVED'";
    $stmtt = $conn->prepare($sqlt);
    $stmtt->execute();
    $rowt = $stmtt->fetchAll(PDO::FETCH_NUM&PDO::FETCH_ASSOC);
    return $rowt;
  }catch (PDOException $et) {
    echo $et->getMessage();
    return $successt;
  }
}

/**
* Fills empty RM_Form with selection from the database.
*
* @param mixed $rowt Rowt is the array that will be constructed in the __construct method
* @throws PDOException if the PDO doesn't exist or config.php isn't included
* @return Array that is used to fill in empty RM_Form
*/
public static function hrFillForm($rowt) {
include("../config.php");
  $successt = false;
  try{
    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sqlt = "SELECT * FROM rmemform WHERE status = 'WAITING FOR SO_NUM'";
    $stmtt = $conn->prepare($sqlt);
    $stmtt->execute();
    $rowt = $stmtt->fetchAll(PDO::FETCH_NUM&PDO::FETCH_ASSOC);
    return $rowt;
  }catch (PDOException $et) {
    echo $et->getMessage();
    return $successt;
  }
}

/**
* Fills empty vendor RM_Form with selection from the database.
*
* @param mixed $rowt Rowt is the array that will be constructed in the __construct method
* @throws PDOException if the PDO doesn't exist or config.php isn't included
* @return Array that is used to fill in empty RM_Form
*/
public static function vendFillForm($rowt) {
include("../config.php");
  $successt = false;
  try{
    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sqlt = "SELECT * FROM rmemform WHERE status = 'WAITING FOR VENDOR RESPONSE' or status = 'APPLICATION RECEIVED'";
    $stmtt = $conn->prepare($sqlt);
    $stmtt->execute();
    $rowt = $stmtt->fetchAll(PDO::FETCH_NUM&PDO::FETCH_ASSOC);
    return $rowt;
  }catch (PDOException $et) {
    echo $et->getMessage();
    return $successt;
  }
}
/**
* Inserts the current RM_Form object into the database.
*
* @param mixed Empty
* @throws PDOException if the PDO doesn't exist or config.php isn't included
* @return Form submission confirmation
*/
public function processForm() {
  $correct = false;
  try {
    $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO rmemform(position_title, seat_location, cgi_submit_dt,
      num_resource_need, proj_start_dt, tmfp, job_type, est_resource_start_dt,
      est_resource_end_dt, proj_client, confidence, hiring_manager, senior_manager,
      cgi_engage_manager, proj_code, target_salary, rate_crd_cat_lvl, position_desc,
      recommended_hiring, notes, status) VALUES (:ptitle, :sloc, :dsub, :numres,
        :pstart, :TMFP, :type, :rsdate, :rendate, :proj_client,
        :conf_perc, :hir_manag, :sen_manag, :engag_manag, :pcode,
        :t_salary, :rcc_level, :posit_desc, :rec_hire, :notes, :status)";
    $stmt = $con->prepare($sql);
    $stmt->execute(array(
      ':ptitle' => $_POST['ptitle'],
      ':sloc' => $_POST['sloc'],
      ':dsub' => date("Y-m-d", strtotime($_POST['dsub'])),
      ':numres' => $_POST['numres'],
      ':pstart' => date("Y-m-d", strtotime($_POST['pstart'])),
      ':TMFP' => $_POST['TMFP'],
      ':type' => $_POST['type'],
      ':rsdate' => date("Y-m-d", strtotime($_POST['rsdate'])),
      ':rendate' => date("Y-m-d", strtotime($_POST['rendate'])),
      ':proj_client' => $_POST['proj_client'],
      ':conf_perc' => $_POST['conf_perc'],
      ':hir_manag' => $_POST['hir_manag'],
      ':sen_manag' => $_POST['sen_manag'],
      ':engag_manag' => $_POST['engag_manag'],
      ':pcode' => $_POST['pcode'],
      ':t_salary' => $_POST['t_salary'],
      ':rcc_level' => $_POST['rcc_level'],
      ':posit_desc' => $_POST['posit_desc'],
      ':rec_hire' => $_POST['rec_hire'],
      ':notes' => $_POST['notes'],
      ':status' => $_POST['status']
    ));
    return "Form Submitted Successfully <br/> <a href='home.php'>Home</a><br/><a href='../email.php'.>E-mail</a><br/><a href='../logout.php'>Logout</a>";
  }catch(PDOException $e) {
    return $e->getMessage();
  }
}

/**
* Update status.
*
* @param mixed Empty
* @throws PDOException if the PDO doesn't exist or config.php isn't included
* @return Status update confirmation
*/
public function statusUpdate() {
  $good = false;
  try {
    $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE rmemform SET status = :status WHERE RM_ID = '$id'";
    $stmt = $con->prepare($sql);
    $stmt->execute(array(
      ':status' => $_POST['status']
    ));
    $good = true;
    echo "Status Updated Successfully <br/> <a href='home.php'>Home</a>";
  }catch(PDOException $e) {
    $correct = false;
    return $e->getMessage();
  }
  }
}

?>
