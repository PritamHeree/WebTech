<?php 
session_start();

$username  = $_SESSION["username"] ?? "";
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
<head>
<style>
    body {
        background-color: <?php echo $bgColor; ?>;
        color: <?php echo $txtColor; ?>;
        font-family: Arial, sans-serif;
        margin: 20px;
    }
    a {
        color: <?php echo $linkColor; ?>;
        margin-right: 15px;
    }
    table {
        border-collapse: collapse;
    }
    td {
        padding: 10px;
        border: 1px solid #cccccc;
    }
    input, select {
        padding: 5px;
    }
    select {
        width: 150px;
    }
</style>
</head>
<body>
<h1>Settings for <strong><?php echo htmlspecialchars($username); ?></strong></h1>

<div style="margin-top: 20px;">
    <a href="dashboard.php">Dashboard</a>
    <a href="../controllers/AuthController.php?action=logout">Logout</a>
</div>

<h2>Theme Preferences</h2>
<p>Current Theme: <strong><?php echo ucfirst($theme); ?></strong></p>

<form method="post" action="../controllers/PreferenceController.php?action=updateTheme">
<table>
    <tr>
        <td>Select Theme</td>
        <td>
            <select name="theme" required>
                <option value="light" <?php echo ($theme === "light") ? "selected" : ""; ?>>Light</option>
                <option value="dark" <?php echo ($theme === "dark") ? "selected" : ""; ?>>Dark</option>
            </select>
        </td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" name="submit" value="Save Preference"/></td>
    </tr>
</table>
</form>

</body>
</html>