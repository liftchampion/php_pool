<?php
    function auth($login, $passwd_hash) {
        if ($login == "" || $passwd_hash == "") {
            return false;
        }
//        echo "1";
        if (!file_exists("../db/users.json")) {
            return false;
        }
//        echo "2";
        $file = file_get_contents("../db/users.json");
        if ($file === false) {
            return false; // fixme read file error
        }
//        echo "3";
        if (($data = json_decode($file, true)) == FALSE){
            return false; //fixme json error
        }
//        echo "4";
//        print_r($data);
        if ($data[$login]["passwd"] == $passwd_hash) {
            return ($data[$login]);
        }
//        echo "5";
        return false;
    }