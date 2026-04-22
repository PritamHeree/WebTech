<?php 
session_start();

$username = $_POST["username"];
$password = $_POST["password"];
$captcha = $_POST["captcha"];

$hasUsernameError = true;
$hasPasswordError = true;
$hasCaptchaError = true;

if(!$username){
    $_SESSION["usernameError"] = "Username is required";
    $hasUsernameError = true;
}else{
    unset($_SESSION["usernameError"]);
    $hasUsernameError = false;
}

if(!$password){
    $_SESSION["passwordError"] = "Password is required";
    $hasPasswordError = true;
}else{
    unset($_SESSION["passwordError"]);
    $hasPasswordError = false;
}

if($hasUsernameError || $hasPasswordError){
    $_SESSION["username"] = $username;
    Header("Location: ../View/login.php");
    exit();
}else{
    $users = array("Pritam"=>"123456", "Samiha"=>"12345", "Hamid"=>"1234567");
    $isFound = false;
    foreach($users as $user=>$pass){
        if($username === $user && $password === $pass){
            $isFound = true;
            $_SESSION["username"] = $username;
            $_SESSION["isLoggedIn"] = true;
            Header("Location: ../View/dashboard.php");
            exit();
        }
    }
    if(!$isFound){
        $_SESSION["credentialError"] = "Your username or password is incorrect!";
        Header("Location: ../View/login.php");
        exit();
    }
}
?>