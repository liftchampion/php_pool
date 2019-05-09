<?php
    $cart_time = 60*60;
    include "json.php";
    include "make_cart.php";
    if (!session_start()) {
        echo "ERROR\n";
        exit(0); // fixme session error
    }
////// CHECK IF ORDER FINISHED AND CLEAR CART
    protect_cart();
///// MAKE CART
    make_cart_if_need();
///// ADD TO CART
    $cart = json_decode($_COOKIE["cart"], true);
    if ($cart === FALSE) {
        echo "ERROR\n";
        exit (0); // fixme json error
    }
    $count = trim($_POST["count"]);
    $id = trim($_POST["id"]);
    if ($count == "") {
        $count = "0";
    }
    if (!preg_match("/^[0123456789]+$/", $count)) {
        $count = 0;
    }
    $products = get_json("goods");
    if ($products[$id] === NULL) {
        header("Location: ../index.php");
        exit(0);
    }
    if ($count > $products[$id]["count"]) {
        $count = $products[$id]["count"];
    }
    if ($count == 0) {
        header("Location: ../index.php");
        exit(0);
    }
    if ($cart["goods"][$id] === NULL) {
        $cart["goods"][$id] = 0;
    }
    $cart["goods"]["{$id}"] += $count;
    $encoded = json_encode($cart);
    if ($encoded === FALSE) {
        echo "ERROR\n";
        exit (0); // fixme json error
    }
    if (setcookie("cart", $encoded,time() + $cart_time) === FALSE) {
        echo "ERROR\n";
        exit (0); // fixme cookie error
    }
    header("Location: ../index.php");

