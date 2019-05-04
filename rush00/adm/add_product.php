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
    $_SESSION["last_query"] = "add_product";
    $pname = trim($_POST["pname"]);
    $price = trim($_POST["price"]);
    if ($price == "") {
        $price = "0";
    }
    if (!preg_match("/[\d]+/", $price)) {
        header("Location: adm.php");
        $_SESSION["query_msg"] = "Bad price";
        exit(0);
    }
    if ($pname == "") {
        header("Location: adm.php");
        exit();
    }
    $products = get_json("goods");
    if (find_product($products, $pname)) {
        header("Location: adm.php");
        $_SESSION["query_msg"] = "Product with this name exists";
        exit(0);
    }
    $new_product["name"] = $pname;
    $new_product["price"] = $price;
    $format = [];
    if ($_FILES['new_img']['error'] != 0) {
        header("Location: adm.php");
        $_SESSION["query_msg"] = "Error during uploading file";
        exit(0);
    }
    if ($_FILES['new_img']['size'] == 0) {
        $new_product["img"] = "no.png";
        $products[] = $new_product;
        set_json($products, "goods");
        header("Location: adm.php");
        $_SESSION["query_msg"] = "Product successfully added with {$new_product['img']}";
        exit(0);
    }
    if (!preg_match("/\.(jpg|jpeg|tif|tiff|png|gif|bmp)$/", $_FILES['new_img']['name'], $format)) {
        $new_product["img"] = "no.png";
        header("Location: adm.php");
        $_SESSION["query_msg"] = "Bad image";
        exit(0);
    }
    $file_name = (count($products) + 1000).$format[0];
    if (!move_uploaded_file($_FILES['new_img']['tmp_name'], "../imgs/".$file_name)) {
        header("Location: adm.php");
        $_SESSION["query_msg"] = "Bad image";
        exit(0);
    }
    $new_product["img"] = $file_name;
    $products[] = $new_product;
    set_json($products, "goods");
    header("Location: adm.php");
    $_SESSION["query_msg"] = "Product successfully added with {$new_product['img']}";
