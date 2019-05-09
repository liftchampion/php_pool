<?php
    function get_id($data) {
        $max_id = -1;
        foreach ($data as $key => &$val) {
            if ($key > $max_id) {
                $max_id = $key;
            }
        }
        return ($max_id + 1);
    }
    include "json.php";
    include "make_cart.php";
    if (!session_start()) {
        echo "ERROR\n";
        exit(0); // fixme session error
    }
    protect_cart();
    make_cart_if_need();
    $orders = get_json("orders");
    $time = time();
    $address = trim($_POST["address"]);
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $address = trim($_POST["address"]);
    $login = trim($_POST["login"]);
    $phone = trim($_POST["phone"]);
    $cart_coded = trim($_COOKIE["cart"]);
    $cart = json_decode($cart_coded, true);
    if ($cart === FALSE) {
        echo "ERROR\n";
        exit(0); //fixme json error
    }
    if (count($cart["goods"]) == 0) {
        $_SESSION["order_status"] = "proceeded";
        header("Location: cart.php");
        exit(0);
    }
    $order = [];
    $order["login"] = $login;
    $order["time"] = $time;
    $order["name"] = $name;
    $order["address"] = $address;
    $order["email"] = $email;
    $order["cart"] = $cart;
    $order["id"] = get_id($orders);
    $order["finished"] = false;
    $order["phone"] = $phone;
    $orders[$order["id"]] = $order;
    set_json($orders, "orders");
    $_SESSION["order_status"] = "proceeded";
    header("Location: cart.php");
