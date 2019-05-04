<?php
    //header( "refresh:5; url=index.php" );
//    header("Location: index.php");
    $log = $_POST["login"];
    $pas = $_POST["passwd"];
    //todo check bad usernames
    if ($log == "" || $pas == "") {
        echo "ERROR\n";
        exit(0); // fixme EMPTY name/pass
    }

    if (($file = file_get_contents("../db/users.json")) === FALSE) {
        echo "ERROR\n";
        exit(0); // fixme get error
    }
    if (($data = json_decode($file, true)) === FALSE) {
        echo "ERROR\n";
        exit(0); // fixme json error
    }
    if (in_array($log, $data)) {
        echo "ERROR\n";
        exit(0); // fixme USER EXISTS
    }
    $data[$log] = array(
        "login" => $log,
        "passwd" => hash("sha512", $pas),
        "is_adm" => false);
    if (($encoded = json_encode($data)) === FALSE) {
        echo "ERROR\n";
        exit(0); // fixme json error
    }
    if (!file_put_contents("../db/users.json", $encoded)) {
        echo "ERROR\n";
        exit(0); //fixme put error
    }
    header("Location: index.php");
    echo "OK\n";
