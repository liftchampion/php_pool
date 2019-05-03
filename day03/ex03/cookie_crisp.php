<?php
    $exp = 100;
    $action = $_GET["action"];
    $name = $_GET["name"];
    $value = $_GET["value"];
    if ($action == "set") {
        setcookie($name, $value, time() + $exp);
    }
    else if ($action == "get") {
        if ($_COOKIE[$name] !== null) {
            echo $_COOKIE[$name] . "\n";
        }
    }
    else if ($action == "del") {
        setcookie($name,"expired",time()-1);
    }
