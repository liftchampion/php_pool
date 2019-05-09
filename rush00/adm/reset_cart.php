<?php
include "json.php";
include "make_cart.php";
if (!session_start()) {
    echo "ERROR\n";
    exit(0); // fixme session error
}
make_cart_if_need();
protect_cart();
unset($_COOKIE["cart"]);
setcookie("cart", "", -1);
header("Location: cart.php");
