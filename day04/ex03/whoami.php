<?php
    session_start();
    $log = $_SESSION["loggued_on_user"];
    if ($log == "") {
        echo "ERROR\n";
    }
    else {
        echo $log."\n";
    }