<?php
session_start();
$isLoggedIn = $_SESSION["isLoggedIn"] ?? false;
if($isLoggedIn){
    Header("Location: views/dashboard.php");
    exit();
}else{
    Header("Location: views/login.php");
    exit();
}
?>