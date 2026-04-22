<?php 
session_start();

$username  = $_SESSION["username"] ?? "";
$loginTime = $_SESSION["loginTime"] ?? "";
$isLoggedIn = $_SESSION["isLoggedIn"] ?? false;

if(!$isLoggedIn) {
    header("Location: login.php");
    exit();
}

$theme    = $_COOKIE["theme"] ?? "light";
$bgColor  = ($theme === "dark") ? "#2d2d2d" : "#ffffff";
$txtColor = ($theme === "dark") ? "#ffffff" : "#000000";
$linkColor = ($theme === "dark") ? "#87ceeb" : "#0066cc";

?>

<html>
<body style="background-color: <?php echo $bgColor; ?>; color: <?php echo $txtColor; ?>; font-family: Arial, sans-serif; margin: 20px;">
    <h1>HelloHieeee! Welcome to Dashboard <strong><?php echo htmlspecialchars($username); ?></strong></h1>
    <p>Login Time: <?php echo $loginTime; ?></p>

    <div style="margin-top: 20px;">
        <a href="settings.php" style="color: <?php echo $linkColor; ?>; margin-right: 15px;">Settings</a>
        <a href="../controllers/AuthController.php?action=logout" style="color: <?php echo $linkColor; ?>;">Logout</a>
    </div>
</body>
</html>