<?php
    function find_user($log, $data) {
        foreach ($data as &$ent) {
            if ($ent["login"] == $log) {
                return (true);
            }
        }
        return (false);
    }
    function delay() {
        $e = 0;
    }
    //header( "refresh:5; url=index.html" );
    header("Location: index.html");
    $log = $_POST["login"];
    $pas = $_POST["passwd"];
    $sub = $_POST["submit"];
    if ($log == "" || $pas == "" || $sub != "OK") {
        echo "ERROR\n";
        delay();
        exit(0);
    }
    if (!file_exists("../private/passwd")) {
        mkdir("private", 0755);
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
        delay();
        exit(0);
    }
    $data[] = array(
        "login" => $log,
        "passwd" => hash("sha512", $pas)
    );
    file_put_contents("../private/passwd", serialize($data));
    echo "OK\n";
    delay();
