<?php
    include "json.php";
    include "make_cart.php";
    if (!session_start()) {
        echo "ERROR\n";
        exit(0); // fixme session error
    }
    if ($_SESSION["order_status"] == NULL) {
        $_SESSION["order_status"] = "not_made";
    }
    protect_cart();
    if ($_POST["checkout"] == "Checkout") {
        $_SESSION["order_status"] = "checking";
    }
    make_cart_if_need();
    $cart = json_decode($_COOKIE["cart"], true);
    if ($cart === FALSE) {
        echo "ERROR\n";
        exit (0); // fixme json error
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cart</title>
    <link rel="stylesheet" type="text/css" href="../style/landing.css">
    <link href="https://fonts.googleapis.com/css?family=Gugi" rel="stylesheet">
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
            <a href="login2.php" class="hdlinks">Login</a>
            <span class="line"></span>
        </nav>
    </header>
    <div class="right_header">
        <!--    <a href="logout.php">Войти</a>-->
    </div>
</div>
<div class="arealogin3">
<?php
    $is_empty = false;
    if (!is_array($cart["goods"])) {
        $is_empty = true;
    }
    if (!$is_empty) {
        if (count($cart["goods"]) == 0) {
            $is_empty = true;
        }
    }
    if ($is_empty) {
        ?>
<p class='cart_texts'>Nothing in cart yet</p>
<a href="../index.php">Go back</a>
        <?php
        exit(0); // todo exist to early not print congrat message
    }
    else {
        $products = get_json("goods");
        $cart_total = 0;
        echo "<p class='cart_texts'><div class='elem2'>Name</div><div class='elem2'>Price per unit</div><div class='elem2'>Count</div><div class='elem2'>Total cost</div></p>";
        foreach ($cart["goods"] as $id => &$count) {
            if ($count > $products[$id]['count']) {
                $count = $products[$id]['count'];
            }
            if ($count == 0) {
                continue;
            }
            $cost = $products[$id]['price'] * $count;
            $cart_total += $cost;
            echo "<p class='cart_texts'><div class='elem'>{$products[$id]['name']}</div><div class='elem'>{$products[$id]['price']}</div><div class='elem'>{$count}</div><div class='elem'>{$cost}</div></p>";
        }
    }
    echo "<div class='elem3'>Total: {$cart_total}</div>";
    if ($_SESSION["order_status"] == "not_made") {
        ?>
        <form name="cart.php" action="cart.php" method="post">
            <input type="submit" name="checkout" value="Checkout" class="okbutton">
        </form>
<?php
    }
    if ($_SESSION["order_status"] == "checking") {
        $encoded = json_encode($cart);
        $_POST["checkout"] = "";
        if ($encoded === FALSE) {
            echo "ERROR\n";
            exit(0); // fixme json error
        }
        ?>
        <form name="cart.php" action="make_order.php" method="post">
            <input type="hidden" name="login" value="<?php echo $_SESSION["log"]?>">
            <h1>Name: </h1><input type="text" name="name" value="">
            <br />
            <h1>Mobile phone: </h1><input type="tel" name="phone" value="" style="height: 30px">
            <br />
            <h1>Email: </h1><input type="email" name="email" value="" style="height: 30px">
            <br />
            <h1>Address: </h1><input type="text" name="address" value="" style="height: 30px">
            <br />
            <input type="submit" name="checkout" class="okbutton">
        </form>
<?php
    }
    if ($_SESSION["order_status"] == "proceeded") {
        echo "<p class='cart_texts'>Thanks for your order. Our courier will call you</p>";
        $_POST["checkout"] = "";
        $_SESSION["order_status"] = "done";
    }

?>
<br />
<a href="../index.php" class="okbutton">Go back</a> <a href="reset_cart.php" class="okbutton">Reset cart</a>
</div>
</body>
</html>
