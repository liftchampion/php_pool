<?php
    //header( "refresh:5; url=index.php" );
//    header("Location: index.php");
    include ("json.php");
    $log = $_POST["login"];
    $pas = $_POST["passwd"];
    //todo check bad usernames
    if ($log == "" || $pas == "") {
        echo "ERROR\n";
        exit(0); // fixme EMPTY name/pass
    }
    $data = get_json("users");
    if ($data[$log] !== NULL) {
        echo "ERROR\n";
        exit(0); // fixme USER EXISTS
    }
    $data[$log] = array(
        "login" => $log,
        "passwd" => hash("sha512", $pas),
        "is_adm" => false);
    set_json($data, "users");
    header("Location: ../index.php");
    echo "OK\n";
