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
    $pid = trim($_POST["to_rm"]);
    if ($pid == "") {
        header("Location: adm.php");
        exit(0);
    }
    $_SESSION["last_query"] = "rm_prod";
    $data = get_json("goods");
    if ($data[$pid] === NULL) {
        $_SESSION["query_msg"] = "This product doesn't exist";
        header("Location: adm.php");

    } else {
        $_SESSION["query_msg"] = "Successfully removed product {$pid}";
        unset($data[$pid]);
        set_json($data, "goods");
        header("Location: adm.php");
    }
