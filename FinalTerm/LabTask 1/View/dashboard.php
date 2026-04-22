<?php 
session_start();
$username = $_SESSION["username"] ?? "";
$isLoggedIn = $_SESSION["isLoggedIn"] ?? false;
if(!$isLoggedIn){
    Header("Location: login.php");
    exit();
}

$isCookieSet = isset($_COOKIE["favoriteFood"]);
$favFood = '';
if($isCookieSet){
    $favFood = $_COOKIE["favoriteFood"];
}

?>

<html>
<body>
    <h1>HelloHi! Welcome to Dashboard <strong><?php echo $username;?></strong></h1>
    <a href="../Controller/logout.php">Logout</a>

    <div>
        <?php 
        if(!$isCookieSet){
            echo "<div style='margin-top: 20px;'>
                <form method='post' action='../Controller/handleCookie.php'>
                    <label>Favorite Food: </label>
                    <input type='text' name='favFood' placeholder='Enter your favorite Food'/>
                    <input type='submit' name='submit'/>
                </form>
            </div>";
        }else{
            echo "<div>
                <p>Hi $username, We know your favorite food.</p>
                <p>Your favorite food is $favFood</p>
                <form method='post' action='../Controller/deleteCookie.php'>
                    <button type='submit'>Delete Cookies</button>
                </form>
            </div>";
        }
        ?>
    </div>

</body>
</html>