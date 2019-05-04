<?php
    include "auth.php";
    $log = $_POST["login"];
    $pas = $_POST["passwd"];
    session_start();
    if (auth($log, $pas) === false) {
        $log = "";
        $pas = "";
    }
    $_SESSION["loggued_on_user"] = $log;
    if ($_SESSION["loggued_on_user"] != "") {
        echo "OK\n";
    }
    else {
        echo "ERROR\n";
    }
