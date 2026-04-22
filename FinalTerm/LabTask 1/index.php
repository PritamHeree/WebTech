<?php 
session_start();

$isLoggedIn = $_SESSION["isLoggedIn"] ?? false;

if($isLoggedIn) {
    header("Location: View/dashboard.php");
} else {
    header("Location: View/login.php");
}

?>
