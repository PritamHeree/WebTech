<?php 
session_start();

$usernameError        = $_SESSION["usernameError"] ?? "";
$emailError           = $_SESSION["emailError"] ?? "";
$passwordError        = $_SESSION["passwordError"] ?? "";
$confirmPasswordError = $_SESSION["confirmPasswordError"] ?? "";
$registrationError    = $_SESSION["registrationError"] ?? "";

$username = $_SESSION["username"] ?? "";
$email    = $_SESSION["email"] ?? "";

$isLoggedIn = $_SESSION["isLoggedIn"] ?? false;

if($isLoggedIn) {
    header("Location: dashboard.php");
    exit();
}

unset($_SESSION["usernameError"]);
unset($_SESSION["emailError"]);
unset($_SESSION["passwordError"]);
unset($_SESSION["confirmPasswordError"]);
unset($_SESSION["registrationError"]);
unset($_SESSION["username"]);
unset($_SESSION["email"]);

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
<h1>Registration Form</h1>
<?php if($registrationError): ?>
    <p style="color:red"><?php echo $registrationError; ?></p>
<?php endif; ?>

<form method="post" action="../controllers/AuthController.php?action=register">
<table>
    <tr>
        <td>Username</td>
        <td><input type="text" name="username" placeholder="Enter username (min 3 chars)" value="<?php echo htmlspecialchars($username); ?>"/></td>
        <td style="color:red"><?php echo $usernameError; ?></td>
    </tr>
    <tr>
        <td>Email</td>
        <td><input type="email" name="email" placeholder="Enter valid email" value="<?php echo htmlspecialchars($email); ?>"/></td>
        <td style="color:red"><?php echo $emailError; ?></td>
    </tr>
    <tr>
        <td>Password</td>
        <td><input type="password" name="password" placeholder="Enter password (min 6 chars)"/></td>
        <td style="color:red"><?php echo $passwordError; ?></td>
    </tr>
    <tr>
        <td>Confirm Password</td>
        <td><input type="password" name="confirmPassword" placeholder="Confirm password"/></td>
        <td style="color:red"><?php echo $confirmPasswordError; ?></td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" name="submit" value="Register"/></td>
    </tr>
    <tr>
        <td></td>
        <td><a href="login.php">Already have an account? Login here</a></td>
    </tr>
</table>
</form>

</body>
</html>