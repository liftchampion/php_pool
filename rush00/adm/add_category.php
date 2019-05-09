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
    $cat = trim($_POST["new_cat"]);
    if ($cat == "") {
        header("Location: adm.php");
        exit(0);
    }
    $data = get_json("cats");
    $_SESSION["last_query"] = "add_cat";
    if (in_array($cat, $data)) {
        header("Location: adm.php");
        $_SESSION["query_msg"] = "This cat already exists";
    }
    else {
        $data[] = $cat;
        set_json($data, "cats");
        header("Location: adm.php");
        $_SESSION["query_msg"] = "Successfully added category {$cat}";
    }