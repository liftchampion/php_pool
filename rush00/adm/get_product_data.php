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
    $pid = trim($_POST["pid"]);
    if ($pid == "") {
        header("Location: adm.php");
        exit(0);
    }
    $data = get_json("goods");
    $_SESSION["last_query"] = "edit_product_get";
    if ($data[$pid] === NULL || $data[$pid]["name"] == "nogood") {
        header("Location: adm.php");
        $_SESSION["query_msg"] = "<p class='adm_texts'>This product doesn't exist</p>";
    }
    else {
        $data[] = $pid;
        header("Location: adm.php");
        $_SESSION["query_msg"] = "Successfully get";
        $_SESSION["query_load"] = $data[$pid];
        $_SESSION["query_load"]["pid"] = $pid;
    }
