<?php
    include "auth.php";
    $log = $_POST["login"];
    $pas = $_POST["passwd"];

    if (!file_exists("../db/users.json")) {
        if (!file_exists("../db")) {
            if (mkdir("../db") === false) {
                exit(0); // fixme mkdir error
            }
        }
        $init = array("admin" => array(
            "login" => "admin",
            "passwd" => "admin",
            "is_adm" => true));
        if (($encoded = json_encode($init)) === FALSE) {
            echo "ERROR\n";
            exit(0); // fixme json error
        }
        if (!(file_put_contents("../db/users.json", $encoded))) {
            echo "ERROR\n";
            exit(0); // fixme put error
        }
    }

    if (($user = auth($log, $pas)) === false) {
        echo "ERROR\n";
        exit(0);
    }
    if (session_start() === FALSE) {
        echo "ERROR\n";
        exit(0); // fixme session error
    }
    $_SESSION["log"] = $log;
    $_SESSION["is_adm"] = $user["is_adm"];
    echo "OK\n";
