<?php
    include "auth.php";
    $log = trim($_POST["login"]);
    $pas = trim($_POST["passwd"]);

    if (($user = auth($log, hash("sha512", $pas))) === false) {
        echo "ERROR4\n";
        exit(0);
    }
    if (session_start() === FALSE) {
        echo "ERROR5\n";
        exit(0); // fixme session error
    }
    $_SESSION["log"] = $log;
    $_SESSION["is_adm"] = $user["is_adm"];
    header("Location: ../index.php");
    echo "OK\n";
