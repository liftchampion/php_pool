<?php
    include "json.php";
    include "make_cart.php";
    if (!file_exists("../db/goods.json") ||
        !file_exists("../db/users.json") ||
        !file_exists("../db/cats.json")  ||
        !file_exists("../db/orders.json")) {
        header("Location: install.php");
    }
    if (!session_start()) {
        echo "ERROR\n";
        exit(0); // fixme session error
    }
    protect_cart();
    make_cart_if_need();
    if ($_SESSION["order_done"]) {
        $_SESSION["order_done"] = false;
        unset($_COOKIE["cart"]);
        setcookie("cart", $encoded,-1);
    }
    $is_adm = $_SESSION["is_adm"];
    $log = $_SESSION["log"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<?php
    if ($log != "") {
        echo "<h2>Logged as {$log}</h2>";
    }
    else {
        echo "<h2>Login</h2>";
    }
?>
<form name="login.php" action="login.php" method="post">
    Username: <input type="text" name="login" value="">
    <br />
    Password: <input type="password" name="passwd" value="">
    <input type="submit" name="submit" value="OK">
</form>
<a href="create.html">Register account</a>
<br />
<?php
    if ($is_adm) {
        echo '<a href="adm.php">Adm area</a>';
    }
    else if ($log != "") {
        echo '<a href="adm.php">User info</a>';
    }
    if ($log != "") {
        echo '<br /><a href="logout.php">Logout</a>';
    }
    ?>
<br />
<br />
<?php
    $products = get_json("goods");
    foreach ($products as &$p) {
        ?>
<form name="add_to_cart.php" action="add_to_cart.php" method="post">
    <?php echo $p["name"] ?> <input type="text" name="count" value="1">
    <input type="hidden" name="id" value=<?php echo $p["id"]?>>
    <input type="submit" name="submit" value="Add">
</form>
<?php
    }
    print_r($_COOKIE["cart"]);
?>
<br />
<a href="cart.php">Cart</a>
</body>
</html>