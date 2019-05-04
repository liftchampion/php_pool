<?php
    function auth($login, $passwd_hash) {
        if ($login == "" || $passwd_hash == "") {
            return false;
        }
        if (!file_exists("../db/users")) {
            return false;
        }
        $file = file_get_contents("../db/users");
        if ($file === false) {
            return false; // fixme read file error
        }
        if (($data = json_decode($file)) !== TRUE){
            return false; //fixme json error
        }
        if ($data[$login]["passwd"] == $passwd_hash) {
            return ($data[$login]);
        }
        return false;
    }