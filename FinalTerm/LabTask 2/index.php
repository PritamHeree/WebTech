<?php 
session_start();

$isLoggedIn = $_SESSION["isLoggedIn"] ?? false;

if($isLoggedIn) {
    header("Location: views/dashboard.php");
} else {
    header("Location: views/register.php");
}

?>