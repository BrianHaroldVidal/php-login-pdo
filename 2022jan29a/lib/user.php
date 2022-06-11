<?php
include_once 'session.php';
include      'database.php';
include      './config.php';

class user {
    private $db;
    public function __construct(){
        $this->db = new ondatabase;  
    }
    
    public function userRegistration($data){
        $firstname   = $data['firstname'];
        $lastname    = $data['lastname'];
        $email       = $data['email'];
        $password    = $data['password'];
        $cpassword   = $data['cpassword'];
        $emailCheck  = $this->checkEmail($email);
        
        if($firstname == "" && $lastname == "" && $email == "" && $password == "" && $cpassword == ""){
            $msg = "<div class='error'>All Fields Are Required</div>";
            return $msg;
        }elseif($lastname == "" && $email == "" && $password == "" && $cpassword == ""){
            $msg = "<div class='error'>Family Name, Email Address And Passwords Are Required</div>";
            return $msg;
        }elseif($firstname == "" &&  $email == "" && $password == "" && $cpassword == ""){
            $msg = "<div class='error'>First Name,  Email Address And Passwords Are Required</div>";
            return $msg;
        }elseif($firstname == "" && $lastname == "" && $password == "" && $cpassword == ""){
            $msg = "<div class='error'>First Name, Family Name And Passwords Are Required</div>";
            return $msg;
        }elseif($firstname == "" && $lastname == "" && $email == "" &&  $cpassword == ""){
            $msg = "<div class='error'>First Name, Family Name, Email Address And Confirmed Password Are Required</div>";
            return $msg;
        }elseif($firstname == "" && $lastname == "" && $email == "" && $password == "" ){
            $msg = "<div class='error'>First Name, Family Name, Email Address And Password Are Required</div>";
            return $msg;
        }

        if($firstname == ""){
            $msg = "<div class='error'>First Name Is Required</div>";
            return $msg;
        }elseif(strlen($firstname)<2){
            $msg = "<div class='error'>First Name Must Be At least 2 Characters</div>";
            return $msg;
        }elseif(strlen($firstname)>20){
            $msg = "<div class='error'>First Name Must Be Not Exceed 20 Characters</div>";
            return $msg;
        }

        if($lastname == ""){
            $msg = "<div class='error'>Family Name Is Required</div>";
            return $msg;
        }elseif(strlen($lastname)<2){
            $msg = "<div class='error'>Family Name Must Be At least 2 Characters</div>";
            return $msg;
        }elseif(strlen($lastname)>20){
            $msg = "<div class='error'>Family Name Must Be Not Exceed 20 Characters</div>";
            return $msg;
        }
        if($email == ""){
            $msg = "<div class='error'>Email address Is Required</div>";
            return $msg;
        }elseif(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
            $msg = "<div class='error'>Invalid Email Address</div>";
            return $msg;
        }elseif($emailCheck == true){
            $msg = "<div class='error'>Email Address Is Already Exist</div>";
            return $msg;
        }

        if($password == "" && $cpassword == ""){
            $msg = "<div class='error'>Both Passwords Is Required</div>";
            return $msg;
        }elseif($password == ""){
            $msg = "<div class='error'>Password Is Required</div>";
            return $msg;
        }elseif($cpassword == ""){
            $msg = "<div class='error'>Confirmed Password Is Required</div>";
            return $msg;
        }elseif($password != $cpassword){
            $msg = "<div class='error'>Both Passwords Must Match</div>";
            return $msg;
        }elseif(strlen($password)<8 && strlen($cpassword)<8){
            $msg = "<div class='error'>Passwords Must Be At least 8 Characters</div>";
            return $msg;
        }elseif(strlen($password)>20 && strlen($cpassword)>20){
            $msg = "<div class='error'>Passwords Must Be Not Exceed 20 Characters</div>";
            return $msg;
        }

        $query = "INSERT INTO `users` (`user_first_name`, `user_last_name`, `user_email`, `user_password`)
                   VALUES (:firstname, :lastname, :email, :password)";
        $sql = $this->db->pdo->prepare($query);
        $sql->bindValue(':firstname', $firstname);            
        $sql->bindValue(':lastname', $lastname);            
        $sql->bindValue(':email', $email);            
        $sql->bindValue(':password', $password);
        $result = $sql->execute();
        if($result){
            return header("location: profile.php");
        }            
    }

    public function checkEmail($email){
        $query = "SELECT * FROM `users` WHERE `user_email`=:email";
        $sql = $this->db->pdo->prepare($query);
        $sql->bindValue(':email', $email);
        if($sql->rowCount()>0){
            return true;
        }else{
            return false;
        }
    } 

    public function userLogin($data){
        $email     = $data['email'];
        $password  = $data['password'];
        if($email == "" && $password == ""){
            $msg = "<div class='error'>All Fields Are Required</div>";
            return $msg;
        }elseif($email == "" ){
            $msg = "<div class='error'> Email Address Is Required</div>";
            return $msg;
        }elseif($password == ""){
            $msg = "<div class='error'> Password Is Required</div>";
            return $msg;
        }elseif(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
            $msg = "<div class='error'>Invalid Email Address</div>";
            return $msg;
        }
  
        $result = $this->getLogin($email, $password);
        if($result){
            onsession::init();
            onsession::set("login", true);
            onsession::set("id", $result->id);
            onsession::set("firstname", $result->firstname);
            onsession::set("lastname", $result->lastname);
            onsession::set("email", $result->email);
            onsession::set("loginmsg", "<div class='success'>You Have Logged In !!!</div>");
            return header("location: profile.php");      
        }else{
            $msg = "<div class='error'>Either Email Address Or Password Is Incorrect</div>";
            return $msg;
        }

    }


    public function getLogin($email, $password){
        $query = "SELECT * FROM `users` WHERE `user_email`=:email AND `user_password`=:password";
        $sql = $this->db->pdo->prepare($query);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':password', $password);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function create_page(){
        $name = $address = $salary = "";
       $name_err = $address_err = $salary_err = "";

     if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name";
    }elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name"; 
    } else{
        $name = $input_name;
    }

    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
       $address_err = "Please enter an address"; 
    }elseif(!filter_var($input_address, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
       $address_err = "Please enter a valid address and exclude the comma/period";
    }else{ 
       $address = $input_address;
    }

    $input_salary = trim($_POST["salary"]);
    if(empty($input_salary)){
        $salary_err = "Please enter the salary";
    }elseif(!ctype_digit($input_salary)){
        $salary_err = "Please enter a positive integer value and exclude the comma/period.";
    }else{
        $salary = $input_salary;  
    }

    if(empty($name_err) && empty($address_err) && empty($salary_err)){

        $sql = "INSERT INTO employees (name, address, salary) VALUES(?,?,?)";
        if($stmt = mysqli_prepare($link, $sql)){
          mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_address, $param_salary);

          $param_name = $name;
          $param_address = $address;
          $param_salary  = $salary;

          if(mysqli_stmt_execute($stmt)){
              header("location: profile.php");
              exit();
          }else{
              echo "Something went wrong. Please try again later.";
          }

        }
        mysqli_stmt_close($stmt);
    }

   mysqli_close($link);
}
    }

}