<?php
    function auth($login, $passwd) {
        if ($login == "" || $passwd == "") {
            return false;
        }
        if (!file_exists("../private/passwd")) {
            return false;
        }
        $file = file_get_contents("../private/passwd");
        $data = unserialize($file);
        foreach ($data as &$ent) {
            if ($ent["login"] == $login) {
                if ($ent["passwd"] == hash("sha512", $passwd)) {
                    return true;
                }
                else {
                    return false;
                }
            }
        }
        return false;
    }