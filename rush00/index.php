<?php
//include "adm/json.php";
include "adm/make_cart.php";
include("adm/load_data.php");
if (!file_exists("db/goods.json") ||
    !file_exists("db/users.json") ||
    !file_exists("db/cats.json")  ||
    !file_exists("db/orders.json")) {
    header("Location: adm/install.php");
}
if (!session_start()) {
    echo "ERROR\n";
    exit(0); // fixme session error
}
protect_cart();
make_cart_if_need();
$is_adm = false;
$log = "";
if (isset($_SESSION["is_adm"]))
    $is_adm = $_SESSION["is_adm"];
if (isset($_SESSION["log"]))
    $log = $_SESSION["log"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style/landing.css">
    <link href="https://fonts.googleapis.com/css?family=Gugi" rel="stylesheet">
    <title>Shop</title>
</head>

<body>
<div class="header2">
    <a href="index.php"><img id="logo" src="img/logo.png" title="logo" alt="logo"></a>
    <a href="">
        <img id="" src="" title="" alt="">
    </a>
    <div class="cart43">
        <a href="adm/cart.php">
            <img id="cartlogo" src="img/cart.jpeg" title="cart" alt="cart">
        </a>
    </div>
    <header id="header">
        <nav class="links" style="--items: 5;">
            <a href="index.php" class="hdlinks">Main</a>
            <a href="#" class="hdlinks">Company</a>
            <a href="#" class="hdlinks">About</a>
            <a href="#" class="hdlinks">Delivery</a>
            <a href="adm/login2.php" class="hdlinks">Login</a>
            <span class="line"></span>
        </nav>
    </header>
    <div class="right_header">
<!--    <a href="logout.php">Войти</a>-->
    </div>
</div>
<div class="main">
    <div class="left">
        <nav>
            <ul>
                <?php $cat = get_json_path("db/cats.json");
                foreach ($cat as $key) {
                    echo '<li><form class="catname" name="index.php" action="index.php" method="GET">
                   <input class="catnamevalue" type = "submit" name = "cat" value = ' . $key . ' />
                    </form ></li>';
                }
                ?>
            </ul>
        </nav>
    </div>
    <div class="area">
        <?php
        if ($_GET["cat"] === NULL || !in_array($_GET["cat"], $cat)) {
            $curr_cat = "all";
        } else
            $curr_cat = $_GET["cat"];
        //        print($curr_cat);
        $tmp = load_data2($curr_cat);
        //        print_r($tmp);
        foreach ($tmp as $key) {
            if ($key['count'] == 0)
                $w = "net";
            else
                $w = $key['price'];
            echo "</head><body><section>";
            echo "<div style='font-size: 3vw; color: #000000' class='card'>";
            echo "<span class='itemname'>" . $key['name'] . "</span>" . "<br /><img src='" . $key['img'] . "' class='itemimg'><br /><p class='itemname'>" . "$w\n" . "</p>";
//            echo "<span class='itemname'>" . $key['name'] . "</span>" . "<br /><img src='img/$key[name].jpg' class='itemimg'><br /><p class='itemname'>" . "$w\n" . "</p>";
            echo '<form name="cart.php" action="/adm/add_to_cart.php" method="POST" class="formcarditem">
                <span id="text5">Количество: </span><input type="text" name="count" value="" class="countcarditem">
                <input type="hidden" name="id" value="'. $key['id'] .'">
                <input type="submit" value="OK" class="okbutton">
            </form>';
            echo "</div></section></body></html>";
        };
        ?>
    </div>
</div>
</body>
</html>