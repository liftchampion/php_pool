<?php
    include "json.php";
    if (!session_start()) {
        echo "ERROR\n";
        exit(0); // fixme session error
    }
    if (!$_SESSION["is_adm"]) {
    header("Location: index.php");
    exit(0);
    }
    $orders = get_json("orders");
    if ($orders === FALSE) {
        echo "ERROR\n";
        exit(0); //fixme json error
    }
    foreach ($_POST as $key => $value) {
        if (preg_match("/^order_/", $key) && $value == "on") {
            $orders[str_replace("order_", "", $key)]["finished"] = true;
        }
    }
    if (set_json($orders, "orders") === FALSE) {
        echo "ERROR\n";
        exit(0); //fixme json error
    }
    header("Location: adm.php");

