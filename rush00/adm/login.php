<?php
    include "auth.php";
    $log = $_POST["login"];
    $pas = $_POST["passwd"];
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
        if (($encoded = json_encode($init)) === FALSE) {
            echo "ERROR2\n";
            exit(0); // fixme json error
        }
        if (!(file_put_contents("../db/users.json", $encoded))) {
            echo "ERROR3\n";
            exit(0); // fixme put error
        }
    }

    if (($user = auth($log, hash("sha512", $pas))) === false) {
        echo "ERROR4\n";
        exit(0);
    }
    if (session_start() === FALSE) {
        echo "ERROR5\n";
        exit(0); // fixme session error
    }
    $_SESSION["log"] = $log;
    $_SESSION["is_adm"] = $user["is_adm"];
    header("Location: index.php");
    echo "OK\n";
