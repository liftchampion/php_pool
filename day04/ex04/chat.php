<?php
    date_default_timezone_set("Europe/Moscow");
//    date("[H:i]", time());
    if (!file_exists("../private/chat")) {
        $data = serialize(array(
            array("login" => "",
                "time" => "",
                "msg" => ""
            )));
    }
    else {
        $fp = fopen("../private/chat", "r+");
        flock($fp, LOCK_EX);
        $data = unserialize(file_get_contents("../private/chat"));
        flock($fp, LOCK_UN);
        fclose($fp);
    }
    echo <<<EOT
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style type="text/css">
        body{
            font: 14px sans-serif;
        }
    </style>
</head>
<body>
EOT;
    foreach ($data as &$ent) {
        if ($ent["msg"] != "") {
            echo date("[H:i] ", $ent["time"])."<b>{$ent['login']}</b>: {$ent['msg']}<br />";
        }
}
    echo "</body>\n</html>\n";
