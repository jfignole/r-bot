<?php
/**
* @author Jonathan Fignole <jonathan.fignole@cgi.com>
*/
class rmClass {
  public $ptitle = null;
  public $sloc = null;
  public $dsub = null;
  public $numres = null;
  public $pstart = null;
  public $TMFP = null;
  public $type = null;
  public $rsdate = null;
  public $rendate = null;
  public $proj_client = null;
  public $hir_manag = null;
  public $sen_manag = null;
  public $engag_manag = null;
  public $pcode = null;
  public $t_salary = null;
  public $rcc_level = null;
  public $posit_desc = null;
  public $rec_hire = null;
  public $notes = null;
  public $soNum = null;
  public $comments = null;
  public $time = null;
/**
* @param mixed $data = array() Array containing valued from the form
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
  }
//Get the $_POST data from the forms and give it to the __construct method
public function storeFormValues($params) {
  //Store the parameters
  $this->__construct($params);
}
/**
* @param mixed $rowt Rowt is the array that will be constructed in the __construct method
* @throws \PDOException try/catch
* @return Array
*/
public static function fillForm($rowt) {
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
* @param mixed Empty
* @throws \PDOException try/catch
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
      recommended_hiring, notes) VALUES (:ptitle, :sloc, :dsub, :numres,
        :pstart, :TMFP, :type, :rsdate, :rendate, :proj_client,
        :conf_perc, :hir_manag, :sen_manag, :engag_manag, :pcode,
        :t_salary, :rcc_level, :posit_desc, :rec_hire, :notes)";
    $copy = "INSERT INTO rmhrform SELECT * rmemform";

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
      ':notes' =>$_POST['notes']
    ));

    return "Form Submitted Successfully <br/> <a href='home.php'>Home</a><br/><a href='../email.php'.>E-mail</a><br/><a href='../logout.php'>Logout</a>";
  }catch(PDOException $e) {
    return $e->getMessage();
  }
}

}
?>
