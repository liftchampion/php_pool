<?php
    function find_product($data, $name) {
        foreach ($data as &$dt) {
            if ($dt["name"] == $name) {
                return true;
            }
        }
        return false;
    }
    include "json.php";
    if (!session_start()) {
        echo "ERROR\n";
        exit(0); // fixme session error
    }
    if (!$_SESSION["is_adm"]) {
        header("Location: index.php");
        exit(0);
    }
    if ($_POST["butt"] == "CANCEL") {
        $_SESSION["last_query"] = "";
        $_SESSION["query_msg"] = "";
        header("Location: adm.php");
        exit(0);
    }
    $pid = trim($_POST["pid"]);
    if ($pid == "") {
        header("Location: adm.php");
        exit(0);
    }
    $data = get_json("goods");
    $_SESSION["last_query"] = "edit_product_get";
    $_SESSION["query_msg"] = "";
    if ($data[$pid] === NULL) {
        header("Location: adm.php");
        $_SESSION["query_msg"] .= "<p class='adm_texts'>Pid not found</p>";
        exit(0);
    }
/////////// NAME
    $pname = trim($_POST["pname"]);
    if ($pname != $data[$pid]["name"]) {
        if ($pname == "") {
            $_SESSION["query_msg"] .= "<p class='adm_texts'>Bad name -> wasn't changed</p>";
        } else {
            if (find_product($data, $pname)) {
                $_SESSION["query_msg"] .= "<p class='adm_texts'>Bad name(already taken) -> wasn't changed</p>";
            } else {
                $data[$pid]["name"] = $pname;
            }
        }
    }
/////////// CAT
    $data[$pid]["cat"] = [];
    foreach ($_POST as $key => $v) {
        if (preg_match("/^cat_/", $key) && $v == "on") {
            $data[$pid]["cat"][] = substr($key,4);
        }
    }
////////// PRICE
    $price = trim($_POST["price"]);
    if ($price == "") {
        $price = "0";
    }
    if (!preg_match("/^[0123456789]+$/", $price)) {
        $_SESSION["query_msg"] .= "<p class='adm_texts'>Bad price -> wasn't changed</p>";
    }
    else {
        $data[$pid]["price"] = $price;
    }
////////// COUNT
    $count = trim($_POST["count"]);
    if ($count == "") {
        $count = "0";
    }
    if (!preg_match("/^[0123456789]+$/", $count)) {
        $_SESSION["query_msg"] .= "<p class='adm_texts'>Bad count -> wasn't changed</p>";
    }
    else {
        $data[$pid]["count"] = $count;
    }
////////// IMG
    $img_url = trim($_POST["img_url"]);
    if ($img_url != "" && $img_url != $data[$pid]["img"]) {
        if ($img_url != $data[$pid]["img"]) {
            if (preg_match("/^http(s)?:\/\//", $img_url)) {
                $data[$pid]["img"] = $img_url;
            } else {
                $_SESSION["query_msg"] .= "<p class='adm_texts'>Bad img url -> wasn't changed</p>";
            }
        }
    } else {
        if ($_FILES['new_img']['size'] != 0) {
            if ($_FILES['new_img']['error'] != 0) {
                $_SESSION["query_msg"] .= "<p class='adm_texts'>Error during uploading img -> wasn't changed</p><br />";
            } else {
                if (!preg_match("/\.(jpg|jpeg|tif|tiff|png|gif|bmp)$/", $_FILES['new_img']['name'], $format)) {
                    $_SESSION["query_msg"] .= "<p class='adm_texts'>Bad img -> wasn't changed</p><br />";
                } else {
                    $file_name = $pid . $format[0];
                    if (!move_uploaded_file($_FILES['new_img']['tmp_name'], "../img/" . $file_name)) {
                        $_SESSION["query_msg"] .= "<p class='adm_texts'>Bad img -> wasn't changed</p><br />";
                    } else {
                        $data[$pid]["img"] = $file_name;
                    }
                }
            }
        }
    }
    set_json($data, "goods");
    header("Location: adm.php");
    $_SESSION["query_msg"] .= "<p class='adm_texts'>Edited pid: {$pid}</p><br />";
