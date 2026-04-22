<?php 
session_start();
require_once 'ValidationModel.php';

$action = $_GET["action"] ?? "";

$usersFile = __DIR__ . '/../models/users.json';

function loadUsers($file){
    if(file_exists($file)){
        $data = file_get_contents($file);
        return json_decode($data, true) ?: array();
    }
    return array();
}

function saveUsers($file, $users){
    file_put_contents($file, json_encode($users));
}

// Register
if($action === "register"){
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    $usernameError = validateUsername($username);
    $emailError = validateEmail($email);
    $passwordError = validatePassword($password);
    $confirmPasswordError = validateConfirmPassword($password, $confirmPassword);

    if($usernameError || $emailError || $passwordError || $confirmPasswordError){
        $_SESSION["usernameError"] = $usernameError;
        $_SESSION["emailError"] = $emailError;
        $_SESSION["passwordError"] = $passwordError;
        $_SESSION["confirmPasswordError"] = $confirmPasswordError;
        $_SESSION["username"] = $username;
        $_SESSION["email"] = $email;
        Header("Location: ../views/register.php");
        exit();
    }

    $users = loadUsers($usersFile);
    foreach($users as $user){
        if($user["username"] === $username){
            $_SESSION["registrationError"] = "Username already exists!";
            $_SESSION["username"] = $username;
            $_SESSION["email"] = $email;
            Header("Location: ../views/register.php");
            exit();
        }
    }

    $newUser = array("username"=>$username, "email"=>$email, "password"=>$password);
    $users[] = $newUser;
    saveUsers($usersFile, $users);

    $_SESSION["username"] = $username;
    $_SESSION["loginTime"] = date("Y-m-d H:i:s");
    $_SESSION["isLoggedIn"] = true;
    Header("Location: ../views/dashboard.php");
    exit();
}

// Login
if($action === "login"){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $hasUsernameError = true;
    $hasPasswordError = true;

    if(!$username){
        $_SESSION["loginUsernameError"] = "Username is required";
        $hasUsernameError = true;
    }else{
        unset($_SESSION["loginUsernameError"]);
        $hasUsernameError = false;
    }

    if(!$password){
        $_SESSION["loginPasswordError"] = "Password is required";
        $hasPasswordError = true;
    }else{
        unset($_SESSION["loginPasswordError"]);
        $hasPasswordError = false;
    }

    if($hasUsernameError || $hasPasswordError){
        $_SESSION["loginUsername"] = $username;
        Header("Location: ../views/login.php");
        exit();
    }else{
        $users = loadUsers($usersFile);
        $isFound = false;
        foreach($users as $user){
            if($username === $user["username"] && $password === $user["password"]){
                $isFound = true;
                $_SESSION["username"] = $username;
                $_SESSION["loginTime"] = date("Y-m-d H:i:s");
                $_SESSION["isLoggedIn"] = true;
                Header("Location: ../views/dashboard.php");
                exit();
            }
        }
        if(!$isFound){
            $_SESSION["credentialError"] = "Your username or password is incorrect!";
            $_SESSION["loginUsername"] = $username;
            Header("Location: ../views/login.php");
            exit();
        }
    }
}

// Logout
if($action === "logout"){
    session_destroy();
    Header("Location: ../views/login.php");
    exit();
}

?>