<?php
    function find_user($log, $data) {
        foreach ($data as &$ent) {
            if ($ent["login"] == $log) {
                return (true);
            }
        }
        return (false);
    }
    //header( "refresh:5; url=index.html" );
//    header("Location: index.html");
    $log = $_POST["login"];
    $pas = $_POST["passwd"];
    $sub = $_POST["submit"];
    if ($log == "" || $pas == "" || $sub != "OK") {
        echo "ERROR\n";
        exit(0);
    }
    if (!file_exists("../private/passwd")) {
        if (!file_exists("../private")) {
            mkdir("../private");
        }
        $init = array(array(
            "login" => "",
            "passwd" => ""
        ));
        file_put_contents("../private/passwd", serialize($init));
    }
    $file = file_get_contents("../private/passwd");
    $data = unserialize($file);
    if (find_user($log, $data)) {
        echo "ERROR\n";
        exit(0);
    }
    $data[] = array(
        "login" => $log,
        "passwd" => hash("sha512", $pas)
    );
    file_put_contents("../private/passwd", serialize($data));
    header("Location: index.html");
    echo "OK\n";
