<?php
    function find_user($log, $data) {
        foreach ($data as &$ent) {
            if ($ent["login"] == $log) {
                return ($ent["passwd"]);
            }
        }
        return ("");
    }
    function upd_user($log, &$data, $new_pas) {
        foreach ($data as &$ent) {
            if ($ent["login"] == $log) {
                $ent["passwd"] = $new_pas;
                return;
            }
        }
    }
    $log = $_POST["login"];
    $opas = $_POST["oldpw"];
    $npas = $_POST["newpw"];
    $sub = $_POST["submit"];
    if ($log == "" || $opas == "" || $npas == "" || $sub != "OK") {
        echo "ERROR\n";
        exit(0);
    }
    if (!file_exists("../private/passwd")) {
        echo "ERROR\n";
        exit(0);
    }
    $file = file_get_contents("../private/passwd");
    $data = unserialize($file);
    $spas = find_user($log, $data);
    if ($spas == "" || $spas != hash("sha512", $opas)) {
        echo "ERROR\n";
        exit(0);
    }
    upd_user($log, $data, hash("sha512", $npas));
    file_put_contents("../private/passwd", serialize($data));
    echo "OK\n";
