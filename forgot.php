<?php 
session_start();
$errors = array();


require "mail.php";
require 'database.php';


$mode = "forgot_password";
if(isset($_GET['mode'])){
    $mode = $_GET['mode'];
}

if(count($_POST) > 0){
    switch($mode){
        case 'forgot_password':
            $email = $_POST['email'];
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                array_push($errors, "Please enter the email associated with your account");
            }else if(!valid_email($email)){
                array_push($errors, "That email is not registered");
            }else{

                $_SESSION['forgot']['email'] = $email;
                send_email($email);
                header("Location: forgot.php?mode=enter_code");
                die;
            }
            break;

        case 'enter_code':
            $code = $_POST['code'];
            $result = is_code_correct($code);

            if($result == "the code is correct"){
                $_SESSION['forgot']['code'] = $code;
                header("Location: forgot.php?mode=new_password");
                die;
            }else{
                $errors[] = $result;
            }
            break;
        
        case 'new_password':
            $password = $_POST['password'];
            $passwordRepeat = $_POST["retype_password"];

            if (strlen($password) < 8){
                array_push($errors, "Password must be at least 8 characters long");
            }

            if (!preg_match("/[0-9]/", $password)){
                array_push($errors, "Password should contain at least one (1) number");
            }

            if (!preg_match("/[A-Z]/", $password)){
                array_push($errors, "Password should contain at least one (1) uppercase letter");
            }

            if (!preg_match("/[a-z]/", $password)){
                array_push($errors, "Password should contain at least one (1) lowercase letter");
            }

            if(!preg_match("/[_\-\+\=\!\@\%\*\&\”\:\.\/\#\$]/", $password)){
                array_push($errors, "Password should contain at least one (1) special character");
            }

            if (preg_match("/\s/", $password)){
                array_push($errors, "Password should not contain any spaces");
            }

            if ($password!==$passwordRepeat){
                array_push($errors, "Password does not match");
            }else if(!isset($_SESSION['forgot']['email']) || !isset($_SESSION['forgot']['code'])){
                header("Location: forgot.php");
                die;
            } else{
                save_password($password);
                if(isset($_SESSION['forgot'])){
                    unset($_SESSION['forgot']);
                }

                header("Location: index.php");
                die;
            }
            break;
        
        default:
            break;

    }
}

function send_email($email){
		
    global $conn;

    $expire = time() + (60 * 1);
    $code = rand(10000,99999);
    $email = addslashes($email);

    $sql = "insert into codes (email,code,expiration) value ('$email','$code','$expire')";
    mysqli_query($conn,$sql);

    
    send_mail($email,'Password reset',"Your code is " . $code);
}

function save_password($password){
		
    global $conn;

    
    $email = addslashes($_SESSION['forgot']['email']);

    $sql = "update cargo set password = '$password' where email = '$email' limit 1";
    mysqli_query($conn,$sql);

}

function valid_email($email){
    global $conn;

    $email = addslashes($email);

    $sql = "SELECT * FROM cargo WHERE email = '$email' limit 1";		
    $result = mysqli_query($conn, $sql);
    if($result){
        if(mysqli_num_rows($result) > 0)
        {
            return true;
         }
    }

    return false;

}

function is_code_correct($code){
    global $conn;

    $code = addslashes($code);
    $expire = time();
    $email = addslashes($_SESSION['forgot']['email']);

    $sql = "select * from codes where code = '$code' && email = '$email' order by id desc limit 1";
    $result = mysqli_query($conn,$sql);
    if($result){
        if(mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_assoc($result);
            if($row['expiration'] > $expire){

                return "the code is correct";
            }else{
                return "the code is expired";
            }
        }else{
            return "the code is incorrect";
        }
    }

    return "the code is incorrect";
}

?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=chrome">
        <meta name="viewport" content="width=device-width", initial-scale="1.0">
        <title>Car&Go</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" type="text/css" href="fontawesome-free-6.4.0-web/css/all.css">
        
    </head>     
    <body>
        <header>
            <a href="index.php#home" class="logo"><img src="img/jeep.png" alt=" "></a>
            <div class="bx bx-menu" id="menu-icon"></div>
            <ul class="navbar">
               <li><a href="index">Home</a></li>
               <li><a href="login.php">Login</a></li>
            </ul>
        </header>
        <?php

            switch($mode){
                case 'forgot_password':
                    ?>
                    <div class="forgot-password-container">
                    <form action= "forgot.php?mode=forgot_password" method="post">
                    <div class="form">
                    <h5>Forgot Password</h5>
                    <h6>Enter your associated email below</h6>
                    <?php
                        foreach($errors as $error){
                            echo $error . "<br>";
                        }
                    ?>
                    <input type="email" name="email" placeholder="Email" class="box"> 
                    <input type="submit" value="Next" class="btn">
                    </div>
                    </form>   
                    </div>
                    <?php
                    break;
                
                case 'enter_code':
                    ?>
                    <div class="enter-code-container">
                    <form action= "forgot.php?mode=enter_code" method="post">
                    <div class="form">
                    <h5>Forgot Password</h5>
                    <h6>Enter the code sent to your associated email</h6>
                    <?php
                        foreach($errors as $error){
                            echo $error . "<br>";
                        }
                    ?>
                    <input type="text" name="code" placeholder="codes" class="box"> 
                    <input type="submit" value="Next" class="btn">
                    <a href = "forgot.php">
                        <input type="button" value = "Back" class="btn">
                    </a>
                    </div>
                    </form>   
                    </div>
                    <?php
                    break;

                case 'new_password':
                    ?>
                    <div class="new-password-container">
                    <form action= "forgot.php?mode=new_password" method="post">
                    <div class="form">
                    <h5>Forgot Password</h5>
                    <h6>Enter your new password</h6>
                    <?php
                        foreach($errors as $error){
                            echo $error  . "<br>";
                        }
                    ?>
                    <input type="password" name="password" id="password-field" placeholder="Password" class="box">
                    <div class="toggle-password">
                    <i class="fa fa-eye"></i>
                    <i class="fa fa-eye-slash"></i>
                    </div>
                    <div class="password-policies">
                    <div class="policy-length">
                    At least eight (8) characters
                    </div>

                    <div class="policy-uppercase">
                    At least one (1) uppercase letter 
                    </div>

                    <div class="policy-lowercase">
                    At least one (1) lowercase letter 
                    </div>

                    <div class="policy-number">
                    At least one (1) number 
                    </div>

                    <div class="policy-special">
                    At least one (1) special character
                    </div>

                    </div>
                    <input type="password" name="retype_password" placeholder="Re-type password" class="box"> 
                    <input type="submit" value="Next" class="btn">
                    </a>
                    </div>
                    </form>   
                    </div>
                    <?php
                    break;
                
                default:
                    break;
            }
        ?>
        
        <script src="signup.js"></script>
    </body>
</html>