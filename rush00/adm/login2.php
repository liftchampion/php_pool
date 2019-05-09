<?php
include "make_cart.php";
//    if (!file_exists("db/goods.json") || !file_exists("db/users.json") || !file_exists("db/cats.json")) {
//        header("Location: adm/install.php");
//    }
    if (!session_start()) {
        echo "ERROR\n";
        exit(0); // fixme session error
    }
protect_cart();
make_cart_if_need();
$is_adm = false;
$log = "";
//if (isset($_SESSION["is_adm"]))
    $is_adm = $_SESSION["is_adm"];
//if (isset($_SESSION["log"]))
    $log = $_SESSION["log"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../style/landing.css">
    <link href="https://fonts.googleapis.com/css?family=Gugi" rel="stylesheet">
    <title>Day of the 42</title>
</head>
<body>
<div class="header2">
    <a href="index.php"><img id="logo" src="../img/logo.png" title="logo" alt="logo"></a>
    <a href="">
        <img id="" src="" title="" alt="">
    </a>
    <div class="cart43">
        <a href="cart.php">
            <img id="cartlogo" src="../img/cart.jpeg" title="cart" alt="cart">
        </a>
    </div>
    <header id="header">
        <nav class="links" style="--items: 5;">
            <a href="../index.php" class="hdlinks">Main</a>
            <a href="#" class="hdlinks">Company</a>
            <a href="#" class="hdlinks">About</a>
            <a href="#" class="hdlinks">Delivery</a>
            <a href="login.php" class="hdlinks">Login</a>
            <span class="line"></span>
        </nav>
    </header>
    <div class="right_header">
        <!--    <a href="logout.php">Войти</a>-->
    </div>
</div>
<div class="arealogin">
<?php
    if ($log != "") {
        echo "<h1>Logged as {$log}</h1>";
    }
    else {
        echo "<h1>Login</h1>";
    }
?>
<form name="login.php" action="login.php" method="post">
    Username: <input type="text" name="login" value="">
    <br />
    Password: <input type="password" name="passwd" value="">
    <input class="catnamevalue" type="submit" name="submit" value="OK">
</form>
<a href="create.html" class="okbutton" style="margin: 10px">Register account</a>
<br />
<?php
    if ($is_adm) {
        echo '<a href="adm.php" class="okbutton" style="margin: 10px">Adm area</a>';
    }
    else if ($log != "") {
        echo '<a href="adm.php" class="okbutton" style="margin: 10px">User info</a>';
    }
    if ($log != "") {
        echo '<br /><a href="logout.php" class="okbutton" style="margin: 10px">Logout</a>';
    }
?>
</div>
</body>
</html>