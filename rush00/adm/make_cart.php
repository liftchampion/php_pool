<?php
    function make_cart_if_need() {
        if ($_COOKIE["cart"] === NULL) {
            $init_cart = [];
            $init_cart["goods"] = [];
            $init_cart["login"] = $_SESSION["log"] != NULL ? $_SESSION["log"] : "";
            $encoded_init = json_encode($init_cart);
            if ($encoded_init === FALSE) {
                echo "ERROR\n";
                exit (0); //fixme json error
            }
            $_COOKIE["cart"] = $encoded_init;
        }
    }
    function protect_cart() {
        if ($_SESSION["order_status"] == "done") {
            $_SESSION["order_status"] = "";
            unset($_COOKIE["cart"]);
            setcookie("cart", "", -1);
        }
        $cart = json_decode($_COOKIE["cart"], true);
        if ($cart === FALSE) {
            echo "ERROR\n";
            exit (0); //fixme json error
        }
        if ($_SESSION["log"] != "" && $cart["login"] != "" && $_SESSION["log"] != $cart["login"]) {
            $_SESSION["order_status"] = "";
            unset($_COOKIE["cart"]);
            setcookie("cart", "", -1);
        }
        if (trim($_SESSION["log"]) != "" && $cart["login"] == "") {
            $cart["login"] = $_SESSION["log"];
            $_COOKIE["cart"] = json_encode($cart);
            if ($_COOKIE["cart"] === FALSE) {
                echo "ERROR\n";
                exit (0); //fixme json error
            }
        }
    }