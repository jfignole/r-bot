<?php
/**
* @package r_bot
*/
class Users {
    /**
    * @author Jonathan Fignole <jonathan.fignole@cgi.com>
    * @copyright  2017 CGI Group Inc.
    * @package r_bot
    */
    /**
    * @var string  username from the database and completed HTML registration form
    */
    public $username = null;
    /**
    * @var string  password from the database and completed HTML registration form
    */
    public $password = null;
    /**
    * @var string  first_name from the database and completed HTML registration form
    */
    public $first_name = null;
    /**
    * @var string  last_name from the database and completed HTML registration form
    */
    public $last_name = null;
    /**
    * @var string  email from the database and completed HTML registration form
    */
    public $email = null;
    /**
    * @var string  user_type from the database and completed HTML registration form
    */
    public $user_type = null;
    /**
    * @var string  salt used to encrypt and hasah password for the database
    */
    public $salt = "i3YkuThgzKgeyzH00me33LleZtZaLOVr5pB7QgH7cGW3nHqivuWIo11tCpr6h6RQ";
    /**
    * Sets the object's properties using the values in the supplied array
    *
    * @param assoc The property values
    */
    public function __construct($data = array()){
        if(isset($data['first_name'])) $this->first_name = stripslashes(strip_tags($data['first_name']));
        if(isset($data['last_name'])) $this->last_name = stripslashes(strip_tags($data['last_name']));
        if(isset($data['username'])) $this->username = stripslashes(strip_tags($data['username']));
        if(isset($data['email'])) $this->email = stripslashes(strip_tags($data['email']));
        if(isset($data['password'])) $this->password = stripslashes(strip_tags($data['password']));
        if(isset($data['user_type'])) $this->user_type = stripslashes(strip_tags($data['user_type']));
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
    * Verifies User against database for Login.
    *
    * @throws PDOException if the PDO doesn't exist or config.php isn't included
    * @return Form submission confirmation
    */
    public function userLogin() {
        //Success variable will be used to return if the login was successful or not
        $success = false;
        try{
            //create our pdo object
            $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            //set how pdo will handle errors
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //this would be our query
            $sql = "SELECT * FROM users WHERE username = :username AND password = :password AND user_type = :user_type LIMIT 1";

            //prepare the statements
            $stmt = $con->prepare($sql);
            //give value to named parameter :username
            $stmt->bindValue("username", $this->username, PDO::PARAM_STR);
            //give value to named parameter :password
            $stmt->bindValue("password", hash("sha256", $this->password . $this->salt), PDO::PARAM_STR);
            //give value to named parameter :user_type
            $stmt->bindValue("user_type", $this->user_type, PDO::PARAM_STR);
            $stmt->execute();

            $valid = $stmt->fetchColumn();

            if($valid) {
                $success = true;
            }
            $con = null;
            return $success;
        }catch (PDOException $e) {
            echo $e->getMessage();
            return $success;
        }
    }
    /**
    * Inserts the registered user into the database.
    *
    * @param mixed Empty
    * @throws PDOException if the PDO doesn't exist or config.php isn't included
    * @return Form submission confirmation
    */
    public function register() {
        $correct = false;
        try {
            $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql2 ="SELECT count(*) FROM users WHERE username = '$this->username' ";
            $stmt2 = $con->prepare($sql2);
            $stmt2->execute();
            $row2 = $stmt2->fetchColumn();

            $row2 = (int)$row2[0];
            if($row2 > 0){
              return  " <script type=\"text/javascript\">
          if (window.confirm('User Already Exists'))
          {
              window.location = 'register.php';
          }
          </script> ";
            }else{
            $sql = "INSERT INTO users(first_name, last_name, username, email,
            password, user_type) VALUES(:first_name, :last_name, :username,
            :email, :password, :user_type)";

            $stmt = $con->prepare($sql);
            $stmt->bindValue("first_name", $this->first_name, PDO::PARAM_STR);
            $stmt->bindValue("last_name", $this->last_name, PDO::PARAM_STR);
            $stmt->bindValue("username", $this->username, PDO::PARAM_STR);
            $stmt->bindValue("email", $this->email, PDO::PARAM_STR);
            $stmt->bindValue("password", hash("sha256", $this->password . $this->salt), PDO::PARAM_STR);
            $stmt->bindValue("user_type", $this->user_type, PDO::PARAM_STR);
            $stmt->execute();
            return  " <script type=\"text/javascript\">
        if (window.confirm('User Added'))
        {
            window.location = 'Project Manager/home.php';
        }
        </script> ";
            }
          }
        catch(PDOException $e) {
            return $e->getMmessage();
        }
    }
}
?>
