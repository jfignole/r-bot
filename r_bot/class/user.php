<?php

class Users {
  public $username = null;
  public $password = null;
  public $salt = "i3YkuThgzKgeyzH00me33LleZtZaLOVr5pB7QgH7cGW3nHqivuWIo11tCpr6h6RQ";

  public function __construct($data = array()){
    if(isset($data['first_name'])) $this->first_name = stripslashes(strip_tags($data['first_name']));
    if(isset($data['last_name'])) $this->last_name = stripslashes(strip_tags($data['last_name']));
    if(isset($data['username'])) $this->username = stripslashes(strip_tags($data['username']));
      if(isset($data['email'])) $this->email = stripslashes(strip_tags($data['email']));
    if(isset($data['password'])) $this->password = stripslashes(strip_tags($data['password']));
    if(isset($data['user_type'])) $this->user_type = stripslashes(strip_tags($data['user_type']));
  }
  //Get the $_POST data from the forms and give it to the __construct method
  public function storeFormValues($params) {
    //Store the parameters
    $this->__construct($params);
  }

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

  public function register() {
    $correct = false;
    try {
          $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
          $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sql = "INSERT INTO users(first_name, last_name, username, email, password, user_type) VALUES(:first_name, :last_name, :username, :email, :password, :user_type)";

          $stmt = $con->prepare($sql);
          $stmt->bindValue("first_name", $this->first_name, PDO::PARAM_STR);
          $stmt->bindValue("last_name", $this->last_name, PDO::PARAM_STR);
          $stmt->bindValue("username", $this->username, PDO::PARAM_STR);
          $stmt->bindValue("email", $this->email, PDO::PARAM_STR);
          $stmt->bindValue("password", hash("sha256", $this->password . $this->salt), PDO::PARAM_STR);
          $stmt->bindValue("user_type", $this->user_type, PDO::PARAM_STR);
          $stmt->execute();
          return "Registration Successful <br/> <a href='index.php'>Login Now</a>";
        }catch(PDOException $e) {
          return $e->getMmessage();
        }
    }

  }

 ?>
