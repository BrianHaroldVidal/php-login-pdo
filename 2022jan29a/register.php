<?php

include 'inc/header.php';
include 'lib/user.php';

$user = new user;
onsession::userLogin();

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    $userRegister = $user->userRegistration($_POST);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/banner.css">
    <link rel="stylesheet" href="css/register.css">
    <title>Register</title>
</head>
<body>
    <div id="banner"></div>
    <div id="registerHeader">
        <div id="register">
            <div id="registerTitle">Register
               <span id="registerClose"><a href="index.php">X</a></span>
            </div><br/><br/>
            <?php
            if(isset($userRegister)){
               echo $userRegister;
            }     
            ?>
            <form action="" method="post">
                <br/><br/>
                <input type="text" name="firstname" id="firstname" placeholder="First Name">
                <br/><br/>
                <input type="text" name="lastname" id="lastname" placeholder="Family Name">
                <br/><br/>
                <input type="text" name="email" id="email" placeholder="Email Address">
                <br/><br/>
                <input type="password" name="password" id="password" placeholder="Password">
                <br/><br/>
                <input type="password" name="cpassword" id="cpassword" placeholder="Confirmed Password">
                <br/><br/>
                <button type="submit" name="submit" id="submit">Submit</button>
                <span id="loginName"><a href="login.php">Login</a></span>
                <br/><br/>
            </form>
        </div>
    </div>
    <script src="js/banner.js"></script>
</body>
</html>