<?php
    include "json.php";
    if (!session_start()) {
        echo "ERROR\n";
        exit(0); // fixme session error
    }
    if (!$_SESSION["is_adm"]) {
        header("Location: index.php");
        exit(0);
    }
    $log = trim($_POST["log_to_adm"]);
    if ($log == "") {
        header("Location: adm.php");
        exit(0);
    }
    $data = get_json("users");
    $_SESSION["last_query"] = "adm_user";
    if ($data[$log] === NULL) {
        header("Location: adm.php");
        $_SESSION["query_msg"] = "User not exists";
    }
    else {
        $data[$log]["is_adm"] = true;
        set_json($data, "users");
        header("Location: adm.php");
        $_SESSION["query_msg"] = "Successfully admed {$log}";
    }
