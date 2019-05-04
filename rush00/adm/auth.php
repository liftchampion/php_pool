<?php
    include ("json.php");
    function auth($login, $passwd_hash) {
        if ($login == "" || $passwd_hash == "") {
            return false;
        }
        $data = get_json("users");
        if ($data[$login]["passwd"] == $passwd_hash) {
            return ($data[$login]);
        }
        return false;
    }