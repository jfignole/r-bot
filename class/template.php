<?php
/**
* @package r_bot
*/
class template {
    /**
    * @author Jonathan Fignole <jonathan.fignole@cgi.com>
    * @copyright  2017 CGI Group Inc.
    * @package r_bot
    */
    /**
    * @var string  position_title from the database and completed HTML registration form
    */
    public $ptitle = null;
    /**
    * @var string  position_desc from the database and completed HTML registration form
    */
    public $posit_desc = null;
    
    /**
    * Sets the object's properties using the values in the supplied array
    *
    * @param assoc The property values
    */
    public function __construct($data = array()){
        if(isset($data['ptitle'])) $this->ptitle = stripslashes(strip_tags($data['ptitle']));
        if(isset($data['posit_desc'])) $this->posit_desc = stripslashes(strip_tags($data['posit_desc']));
    }
    /**
    * Sets the object's properties using the edit form post values in the supplied array
    *
    * @param assoc The form post values
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
            $sql = "INSERT INTO templates (position_title, position_desc) VALUES(:ptitle, :posit_desc)";
            $stmt = $con->prepare($sql);
            $stmt->execute(array(
            ':ptitle' => $_POST['ptitle'],
            ':posit_desc' => $_POST['posit_desc']
            ));
            return "<script type=\"text/javascript\">
                      if (window.confirm('Template Saved'))
                      {
                          window.location = 'home.php'
                      }else{
                          window.location = 'home.php'
                      }
                      </script> ";
        }catch(PDOException $e) {
            return $e->getMessage();
        }
    }
}