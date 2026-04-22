<?php 
session_start();
require_once 'ValidationModel.php';

$action = $_GET["action"] ?? "";

// ---- REGISTER ----
if($action === "register") {
    $username        = $_POST["username"] ?? "";
    $email           = $_POST["email"] ?? "";
    $password        = $_POST["password"] ?? "";
    $confirmPassword = $_POST["confirmPassword"] ?? "";

    $usernameError        = validateUsername($username);
    $emailError           = validateEmail($email);
    $passwordError        = validatePassword($password);
    $confirmPasswordError = validateConfirmPassword($password, $confirmPassword);

    if($usernameError || $emailError || $passwordError || $confirmPasswordError) {
        $_SESSION["usernameError"]        = $usernameError;
        $_SESSION["emailError"]           = $emailError;
        $_SESSION["passwordError"]        = $passwordError;
        $_SESSION["confirmPasswordError"] = $confirmPasswordError;
        $_SESSION["username"]             = $username;
        $_SESSION["email"]                = $email;
        header("Location: ../views/register.php");
        exit();
    }

    // Check if username already exists
    $users = array("Pritam"=>"123456", "Samiha"=>"12345", "Hamid"=>"1234567");
    if(isset($users[$username])) {
        $_SESSION["registrationError"] = "Username already exists. Please choose another.";
        $_SESSION["username"]          = $username;
        $_SESSION["email"]             = $email;
        header("Location: ../views/register.php");
        exit();
    }

    // Successful registration - store in session
    $_SESSION["username"]  = $username;
    $_SESSION["loginTime"] = date("Y-m-d H:i:s");
    $_SESSION["isLoggedIn"] = true;

    header("Location: ../views/dashboard.php");
    exit();
}

// ---- LOGIN ----
if($action === "login") {
    $username = $_POST["username"] ?? "";
    $password = $_POST["password"] ?? "";

    $hasUsernameError = false;
    $hasPasswordError = false;

    if(!$username) {
        $_SESSION["loginUsernameError"] = "Username is required";
        $hasUsernameError = true;
    } else {
        unset($_SESSION["loginUsernameError"]);
    }

    if(!$password) {
        $_SESSION["loginPasswordError"] = "Password is required";
        $hasPasswordError = true;
    } else {
        unset($_SESSION["loginPasswordError"]);
    }

    if($hasUsernameError || $hasPasswordError) {
        $_SESSION["loginUsername"] = $username;
        header("Location: ../views/login.php");
        exit();
    }

    // Authenticate against hardcoded users
    $users = array("Pritam"=>"123456", "Samiha"=>"12345", "Hamid"=>"1234567");
    $isFound = false;

    foreach($users as $user => $pass) {
        if($username === $user && $password === $pass) {
            $isFound = true;
            $_SESSION["username"]   = $username;
            $_SESSION["loginTime"]  = date("Y-m-d H:i:s");
            $_SESSION["isLoggedIn"] = true;
            header("Location: ../views/dashboard.php");
            exit();
        }
    }

    if(!$isFound) {
        $_SESSION["loginError"]    = "Your username or password is incorrect!";
        $_SESSION["loginUsername"] = $username;
        header("Location: ../views/login.php");
        exit();
    }
}

// ---- LOGOUT ----
if($action === "logout") {
    session_destroy();
    header("Location: ../views/login.php");
    exit();
}

?>