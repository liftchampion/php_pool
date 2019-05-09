<?php
    function find_product($data, $name) {
        foreach ($data as &$dt) {
            if ($dt["name"] == $name) {
                return true;
            }
        }
        return false;
    }
    function get_id($data) {
        $max_id = -1;
        foreach ($data as $key => &$val) {
            if ($key > $max_id) {
                $max_id = $key;
            }
        }
        return ($max_id + 1);
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
    $_SESSION["last_query"] = "add_product";
    $pname = trim($_POST["pname"]);
    if ($pname == "") {
        header("Location: adm.php");
        exit();
    }
    $price = trim($_POST["price"]);
    if ($price == "") {
        $price = "0";
    }
    if (!preg_match("/^[0123456789]+$/", $price)) {
        header("Location: adm.php");
        $_SESSION["query_msg"] = "Bad price";
        exit(0);
    }
    $count = trim($_POST["count"]);
    if ($count == "") {
        $count = "0";
    }
    if (!preg_match("/^[0123456789]+$/", $count)) {
        header("Location: adm.php");
        $_SESSION["query_msg"] = "Bad count";
        exit(0);
    }
    $products = get_json("goods");
    if (find_product($products, $pname)) {
        header("Location: adm.php");
        $_SESSION["query_msg"] = "Product with this name exists";
        exit(0);
    }
    $id = get_id($products);
    $new_product["name"] = $pname;
    $new_product["price"] = $price;
    $new_product["count"] = $count;
    $new_product["cat"] = [];
    $new_product["id"] = $id;
    $format = [];
    $img_url = trim($_POST["img_url"]);
    if ($img_url != "") {
        if ($img_url != $data[$pid]["img"]) {
            if (preg_match("/^http(s)?:\/\//", $img_url)) {
                $new_product["img"] = $img_url;
            } else {
                header("Location: adm.php");
                $_SESSION["query_msg"] = "Bad img_url";
                exit(0);
            }
        }
    } else {
        if ($_FILES['new_img']['size'] == 0) {
            $new_product["img"] = "no.png";
            $products[] = $new_product;
            set_json($products, "goods");
            header("Location: adm.php");
            $_SESSION["query_msg"] = "Product successfully added with id: {$id}";
            exit(0);
        }
        if ($_FILES['new_img']['error'] != 0) {
            header("Location: adm.php");
            $_SESSION["query_msg"] = "Error during uploading file";
            exit(0);
        }
        if (!preg_match("/\.(jpg|jpeg|tif|tiff|png|gif|bmp)$/", $_FILES['new_img']['name'], $format)) {
            $new_product["img"] = "no.png";
            header("Location: adm.php");
            $_SESSION["query_msg"] = "Bad image";
            exit(0);
        }
        $file_name = $id . $format[0];
        if (!move_uploaded_file($_FILES['new_img']['tmp_name'], "../img/" . $file_name)) {
            header("Location: adm.php");
            $_SESSION["query_msg"] = "Bad image";
            exit(0);
        }
        $new_product["img"] = $file_name;
    }
    $products[$id] = $new_product;
    set_json($products, "goods");
    header("Location: adm.php");
    $_SESSION["query_msg"] = "Product successfully added with id: {$id}";
