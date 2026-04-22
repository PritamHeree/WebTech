<?php 
session_start();

$loginUsernameError = $_SESSION["loginUsernameError"] ?? "";
$loginPasswordError = $_SESSION["loginPasswordError"] ?? "";
$loginError         = $_SESSION["loginError"] ?? "";

$loginUsername = $_SESSION["loginUsername"] ?? "";

$isLoggedIn = $_SESSION["isLoggedIn"] ?? false;

if($isLoggedIn) {
    header("Location: dashboard.php");
    exit();
}

unset($_SESSION["loginUsernameError"]);
unset($_SESSION["loginPasswordError"]);
unset($_SESSION["loginError"]);
unset($_SESSION["loginUsername"]);

$theme    = $_COOKIE["theme"] ?? "light";
$bgColor  = ($theme === "dark") ? "#2d2d2d" : "#ffffff";
$txtColor = ($theme === "dark") ? "#ffffff" : "#000000";

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
    table {
        border-collapse: collapse;
    }
    td {
        padding: 10px;
        border: 1px solid #cccccc;
    }
    input {
        padding: 5px;
        width: 200px;
    }
</style>
</head>
<body>
<h1>Login Form</h1>
<?php if($loginError): ?>
    <p style="color:red"><?php echo $loginError; ?></p>
<?php endif; ?>

<form method="post" action="../controllers/AuthController.php?action=login">
<table>
    <tr>
        <td>Username</td>
        <td><input type="text" name="username" placeholder="Enter username" value="<?php echo htmlspecialchars($loginUsername); ?>"/></td>
        <td style="color:red"><?php echo $loginUsernameError; ?></td>
    </tr>
    <tr>
        <td>Password</td>
        <td><input type="password" name="password" placeholder="Enter password"/></td>
        <td style="color:red"><?php echo $loginPasswordError; ?></td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" name="submit" value="Login"/></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="register.php">Don't have an account? Register here</a></td>
    </tr>
</table>
</form>

</body>
</html>