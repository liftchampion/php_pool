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
    function find_finished($orders) {
        foreach ($orders as $order) {
            if ($order["finished"] == false) {
                return true;
            }
        }
        return false;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!--    <link rel="stylesheet" href="styles.css">-->
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../style/landing.css">
    <link href="https://fonts.googleapis.com/css?family=Gugi" rel="stylesheet">
</head>
<body>
<div class="header2">
    <a href="index.php"><img id="logo" src="../img/logo.png" title="logo" alt="logo"></a>
    <a href="">
        <img id="" src="" title="" alt="">
    </a>
    <div class="cart43">
        <a href="cart.php">
            <img id="cartlogo" src="../img/cart.jpeg" title="cart" alt="cart">
        </a>
    </div>
    <header id="header">
        <nav class="links" style="--items: 5;">
            <a href="../index.php" class="hdlinks">Main</a>
            <a href="#" class="hdlinks">Company</a>
            <a href="#" class="hdlinks">About</a>
            <a href="#" class="hdlinks">Delivery</a>
            <a href="login.php" class="hdlinks">Login</a>
            <span class="line"></span>
        </nav>
    </header>
    <div class="right_header">
        <!--    <a href="logout.php">Войти</a>-->
    </div>
</div>
<div class="arealogin4">
    <div class="admblock">
<h2 class="adm_title">Rm user</h2>
<form action="rm_user.php" method="post">
    Login: <input type="text" name="log_to_rm" value="" style="height: 30px">
    <input type="submit" value="RM" class="catnamevalue">
</form>
<?php
    if ($_SESSION["last_query"] == "rm_user" && $_SESSION["query_msg"] != "") {
        echo "<p class='adm_texts'>{$_SESSION["query_msg"] }</p>\n";
    }
?>
<h2 class="adm_title">Adm user</h2>
<form action="adm_user.php" method="post">
    Login: <input type="text" name="log_to_adm" value="" style="height: 30px">
    <input type="submit" value="ADM" class="catnamevalue">
</form>
<?php
    if ($_SESSION["last_query"] == "adm_user" && $_SESSION["query_msg"] != "") {
        echo "<p class='adm_texts'>{$_SESSION["query_msg"] }</p>\n";
    }
?>
<h2 class="adm_title">Add category</h2>
<form action="add_category.php" method="post">
    Name: <input type="text" name="new_cat" value="" style="height: 30px">
    <input type="submit" value="ADD" class="catnamevalue">
</form>
<?php
    if ($_SESSION["last_query"] == "add_cat" && $_SESSION["query_msg"] != "") {
        echo "<p class='adm_texts'>{$_SESSION["query_msg"] }</p>\n";
    }
?>
<h2 class="adm_title">Rm category</h2>
<form action="rm_category.php" method="post">
    Name: <input type="text" name="new_cat" value="" style="height: 30px">
    <input type="submit" value="RM" class="catnamevalue">
</form>
<?php
    if ($_SESSION["last_query"] == "rm_cat" && $_SESSION["query_msg"] != "") {
        echo "<p class='adm_texts'>{$_SESSION["query_msg"] }</p>\n";
    }
?>
    </div>
    <div class="admblock">
<h2 class="adm_title">Add new product</h2>
<form enctype="multipart/form-data" action="add_product.php" method="POST">
    Name: <input type="text" name="pname" value="" style="height: 30px">
    <br />
    Price: <input type="text" name="price" value="" placeholder="0" style="height: 30px">
    <br />
    Count: <input type="text" name="count" value="" placeholder="0" style="height: 30px">
    <br />
    Img_url: <input name="img_url" type="text"  style="height: 30px"/>
    <br />
    Img: <input name="new_img" type="file"  style="height: 30px"/>
    <br />
    <input type="submit" value="ADD" class="catnamevalue">
</form>
<?php
    if ($_SESSION["last_query"] == "add_product" && $_SESSION["query_msg"] != "") {
        echo "<p class='adm_texts'>{$_SESSION["query_msg"] }</p>\n";
    }
?>
    </div>
    <div class="admblock">
<h2 class="adm_title">Edit product</h2>
<?php
    if ($_SESSION["query_msg"] != "Successfully get") {
?>
<form action="get_product_data.php" method="POST">
    Id: <input type="text" name="pid" value="" style="height: 30px">
    <input type="submit" value="EDIT" class="catnamevalue">
</form>
<?php
    }
?>
<?php
    if ($_SESSION["last_query"] == "edit_product_get") {
        if ($_SESSION["query_msg"] != "Successfully get") {
            echo $_SESSION['query_msg'];
        }
        else {
            $pdata = $_SESSION["query_load"];
?>
<form enctype="multipart/form-data" action="edit_product.php" method="POST">
    <input type="hidden" name="pid" value="<?php echo $pdata["pid"]?>" />
    Name: <input type="text" name="pname" value="<?php echo $pdata["name"]?>" style="height: 30px">
    <br />
    Price: <input type="text" name="price" value="<?php echo  $pdata["price"]?>" style="height: 30px">
    <br />
    Count: <input type="text" name="count" value="<?php echo  $pdata["count"]?>" placeholder="0" style="height: 30px">
    <br />
    Img_url: <input name="img_url" type="text" value="<?php echo $pdata["img"]?>" style="height: 30px"/>
    <br />
    Img: <input name="new_img" type="file" />
    <br />
    Categories:
    <br />
    <?php
        $cats = get_json("cats");
        if (count($cats) == 0) {
            echo "<p class='adm_texts'>No caterogies yet exist</p>\n";
        }
        else {
            echo "<ul class='adm_dropdown_cats'>\n";
            foreach ($cats as $cat) {
                $cat_name = "cat_".$cat;
                echo "<li><input name=${cat_name} type='checkbox' ".(in_array($cat, $pdata["cat"]) ? "checked" : "")."/>&nbsp;{$cat}</a></li>\n";
            }
            echo " </ul>\n";
        }
    ?>
    <input type="submit" name="butt" value="EDIT" class="catnamevalue"> <input name="butt" type="submit" value="CANCEL" class="catnamevalue">
</form>
<?php
        }
    }
    if ($_SESSION["last_query"] == "edit_product" && $_SESSION["query_msg"] != "") {
        echo "<p class='adm_texts'>{$_SESSION["query_msg"] }</p>\n";
    }
?>
<?php
    $_SESSION["last_query"] = "";
    $_SESSION["query_msg"] = "";
?>
<h2 class="adm_title">Rm product</h2>
<form action="rm_product.php" method="post">
    Name: <input type="text" name="to_rm" value="" style="height: 30px">
    <input type="submit" value="RM" class="catnamevalue">
</form>
<?php
//print_r($_SESSION);
//exit(0);
    if ($_SESSION["last_query"] == "rm_prod" && $_SESSION["query_msg"] != "") {
        echo "AAAAA"; exit(0);
        echo "<p class='adm_texts'>{$_SESSION["query_msg"] }</p>\n";
    }
?>

    <h2 class="adm_title">Active orders</h2>
    <form action="mark_order.php" method="post">

        <?php
            $orders = get_json("orders");
            if ($orders === NULL) {
                echo "ERROR\n";
                exit(0);
            }
            if (!find_finished($orders)) {
                echo "<p class='adm_texts'>No new orders</p>\n";
            }
            else {
                date_default_timezone_set("Europe/Moscow");
                echo "<ul class='adm_dropdown_cats'>\n";
                foreach ($orders as $order) {
                    if ($order["finished"]) {
                        continue;
                    }
                    $order_name = "order_".$order["id"];
                    $encd = json_encode($order["cart"]["goods"]);
                    if ($encd === FALSE) {
                        echo "ERROR\n";
                        exit(0);
                    }
                    $printable_order = date("F j, Y, g:i a", $order["time"])."  ".$order["login"]."  ".$encd.
                    "   ".$order["phone"]."  ".$order["address"]."   ".$order["name"];
                    echo "<li><input name=${order_name} type='checkbox' />&nbsp;{$printable_order}</a></li>\n";
                }
                echo " </ul>\n";
                echo '<input type="submit" name="butt" value="FINISH"  class="catnamevalue">';
            }
        ?>
    </form>
    <?php
    if ($_SESSION["last_query"] == "rm_prod" && $_SESSION["query_msg"] != "") {
        echo "<p class='adm_texts'>{$_SESSION["query_msg"] }</p>\n";
    }
    ?>
    </div>
</div>
</body>
</html>