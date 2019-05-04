<?php
    session_start();
    $_SESSION["log"] = "";
    $_SESSION["is_adm"] = false;
    header("Location: index.php");
