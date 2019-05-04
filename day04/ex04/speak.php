<?php
    session_start();
    if ($_SESSION["loggued_on_user"] != "") {
        if (!file_exists("../private")) {
            mkdir("../private");
        }
        if (!file_exists("../private/chat")) {
            file_put_contents("../private/chat", serialize(array(
                array("login" => "",
                      "time" => "",
                      "msg" => ""
                ))));
        }
        if ($_POST["msg"] != "") {
            $fp = fopen("../private/chat", "r+");
            flock($fp, LOCK_EX);
            $data = unserialize(file_get_contents("../private/chat"));
            $data[] = array("login" => $_SESSION["loggued_on_user"],
                            "time" => time(),
                            "msg" => $_POST["msg"]);
            file_put_contents("../private/chat", serialize($data));
            flock($fp, LOCK_UN);
            fclose($fp);
        }
    }
    else {
        echo "ERROR\n";
        exit(0);
    }
?>
<!DOCTYPE html>
    <style type="text/css">
        body{
            font: 14px sans-serif;
        }
        form{
            margin-top: 17px;
            padding: 0;
        }
        .ipt{
            display: inline-block;
            position: absolute;
            top: 0;
            left: 0;
            margin: 0;
            padding: 0;
            width: calc(99vw - 110px);
            height: 95%;
        }
        input[type=submit]{
            border: none;
            position: relative;
            top: -18px;
            background: blueviolet;
            left: calc(99vw - 114px);
            height: 50px;
            display: inline-block;
            margin: 0;
            padding-left: 5px;
            padding-right: 5px;
            font-size: 40px;
        }
        textarea{
            resize: none;
        }
    </style>
<body>
<script language="javascript">top.frames['chat'].location = 'chat.php';</script>
<form name="speak.php" method="post" action="speak.php">
    <textarea class="ipt" type="text" name="msg" autofocus="autofocus"></textarea>
    <input type="submit" name="submit" value="SEND" onclick="location.reload()">
</form>
</body>
