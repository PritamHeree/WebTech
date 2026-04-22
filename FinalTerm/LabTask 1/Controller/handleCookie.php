<?php 

$favoriteFood = $_POST["favFood"];

setcookie("favoriteFood",$favoriteFood, time()+3600, '/');

Header("Location: ../View/dashboard.php");

?>