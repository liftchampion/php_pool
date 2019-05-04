<?php
    function display_frame() {
//        echo "OK\n";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SuPeR_CHaT!</title>
    <style type="text/css">
        body{
            font: 14px sans-serif;
        }
        .speak {
        background: blueviolet;
        }
    </style>
</head>
<body>
<iframe id="chat" onload="pageScroll()" name="chat" src="chat.php" height="550px" width="100%"></iframe>
<iframe name="speak" class="speak" src="speak.php" height="50px" width="100%" scrolling="no"></iframe>
<a href="logout.php">Logout</a>
</body>
</html>
<?php
    }
    include "auth.php";
    $log = $_POST["login"];
    $pas = $_POST["passwd"];
    session_start();
    if (auth($log, $pas) === false) {
        $log = "";
        $pas = "";
    }
    $_SESSION["loggued_on_user"] = $log;
    if ($_SESSION["loggued_on_user"] != "") {
        display_frame();
    }
    else {
        echo "ERROR\n";
    }
