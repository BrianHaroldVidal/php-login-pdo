<?php

include 'inc/header.php';
include 'lib/user.php';

$user = new user;
onsession::userLogin();

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    $userLogin = $user->userLogin($_POST);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/banner.css">
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
</head>
<body>
    <div id="banner"></div>
    <div id="loginHeader">
        <div id="login">
            <div id="loginTitle">Login
               <span id="loginClose"><a href="index.php">X</a></span>
            </div><br/><br/>
            <?php
            if(isset($userLogin)){
               echo $userLogin;
            }     
            ?>
            <form action="" method="post">
                <br/><br/>
                <input type="text" name="email" id="email" placeholder="Email Address">
                <br/><br/>
                <input type="password" name="password" id="password" placeholder="Password">
                <br/><br/>
                <button type="submit" name="submit" id="submit">Submit</button>
                <span id="registerName"><a href="register.php">Register</a></span>
                <br/><br/>
            </form>
        </div>
    </div>
    <script src="js/banner.js"></script>
</body>
</html>