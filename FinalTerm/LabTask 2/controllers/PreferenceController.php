<?php 
session_start();

$action = $_GET["action"] ?? "";

if($action === "updateTheme") {
    $theme = $_POST["theme"] ?? "light";

    // Store preference in cookie for 30 days
    setcookie("theme", $theme, time() + (30 * 24 * 60 * 60), '/');

    header("Location: ../views/settings.php");
    exit();
}

?>