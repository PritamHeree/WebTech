<?php 
session_start();

$usernameError = $_SESSION["usernameError"] ?? "";
$passwordError = $_SESSION["passwordError"] ?? "";
$captchaError = $_SESSION["captchaError"] ?? "";
$loginError = $_SESSION["credentialError"] ?? "";

$username = $_SESSION["username"] ?? "";
$isLoggedIn = $_SESSION["isLoggedIn"] ?? false;

if($isLoggedIn){
    Header("Location: dashboard.php");
    exit();
}

unset($_SESSION["usernameError"]);
unset($_SESSION["passwordError"]);
unset($_SESSION["captchaError"]);
unset($_SESSION["username"]);
unset($_SESSION["credentialError"]);

// Generate random CAPTCHA values
$num1 = rand(1, 10);
$num2 = rand(1, 10);
$_SESSION["captchaNum1"] = $num1;
$_SESSION["captchaNum2"] = $num2;

?>

<html>
<head>
<script>
function generateCaptcha() {
    var num1 = <?php echo $num1; ?>;
    var num2 = <?php echo $num2; ?>;
    document.getElementById("captchaQuestion").innerHTML = num1 + " + " + num2 + " = ?";
}

function validateCaptcha() {
    var num1 = <?php echo $num1; ?>;
    var num2 = <?php echo $num2; ?>;
    var userAnswer = document.getElementById("captchaAnswer").value;
    var correctAnswer = num1 + num2;
    
    if(userAnswer == correctAnswer) {
        return true;
    } else {
        alert("CAPTCHA answer is incorrect!");
        document.getElementById("captchaAnswer").value = "";
        generateCaptcha();
        return false;
    }
}

window.onload = function() {
    generateCaptcha();
};
</script>
</head>
<body>
<form method="post" action="../Controller/loginValidation.php" onsubmit="return validateCaptcha();">
<table>
    <tr>
        <td>Username</td>
        <td><input type="text" name="username" placeholder="Enter username" value="<?php echo $username;?>"/></td>
        <td style="color:red"><?php echo "$usernameError"; ?></td>
    </tr>
    <tr>
        <td>Password</td>
        <td><input type="password" name="password" placeholder="Enter Password"/></td>
        <td style="color:red"><?php echo "$passwordError"; ?></td>
    </tr>
    <tr>
        <td>CAPTCHA</td>
        <td>
            <div id="captchaQuestion"></div>
            <input type="text" name="captcha" id="captchaAnswer" placeholder="Enter answer"/>
        </td>
        <td style="color:red"><?php echo "$captchaError"; ?></td>
    </tr>
    <tr>
        <td></td>
        <td><p style="color:red"><?php echo $loginError;?></p></td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" name="submit"/></td>
    </tr>
</table>
</form>
</body>
</html>