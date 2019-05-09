<?php
    include "json.php";
    if (!file_exists("../db/users.json")) {
        if (!file_exists("../db")) {
            if (mkdir("../db") === false) {
                echo "ERROR1\n";
                exit(0); // fixme mkdir error
            }
        }
        $init = array("admin" => array(
            "login" => "admin",
            "passwd" => hash("sha512","admin"),
            "is_adm" => true));
        set_json($init, "users");
    }
    unset($init);
    if (!file_exists("../db/goods.json")) {
        if (!file_exists("../db")) {
            if (mkdir("../db") === false) {
                echo "ERROR1\n";
                exit(0); // fixme mkdir error
            }
        }
        $init = [];
        /*$init[] = array(
            "name" => "nogood",
            "img" => "no.png",
            "price" => 0,
            "count" => 0,
            "cat" => [],
            "id" => 0);*/
        set_json($init, "goods");
    }
    unset($init);
    if (!file_exists("../db/cats.json")) {
        if (!file_exists("../db")) {
            if (mkdir("../db") === false) {
                echo "ERROR1\n";
                exit(0); // fixme mkdir error
            }
        }
        set_json([], "cats");
    }
    unset($init);
    if (!file_exists("../db/orders.json")) {
        if (!file_exists("../db")) {
            if (mkdir("../db") === false) {
                echo "ERROR1\n";
                exit(0); // fixme mkdir error
            }
        }
        set_json([], "orders");
    }
    header("Location: ../index.php");
