<?php
    if ($_SERVER['PHP_AUTH_USER'] == null) {
        header('WWW-Authenticate: Basic realm="Restricted Area"');
        header('HTTP/1.0 401 Unauthorized');
    }
    if ($_SERVER['PHP_AUTH_USER'] == "zaz" && $_SERVER['PHP_AUTH_PW'] == "jaimelespetitsponeys") {
        $ct = file_get_contents("../img/42.png");
        $base64 = base64_encode($ct);
        echo <<<EOT
<html><body>
Hello Zaz<br />
<img src='data:image/png;base64,{$base64}'>
</body></html>

EOT;
    }
    else {
        $_SERVER['PHP_AUTH_USER'] = null;
        header('WWW-Authenticate: Basic realm="Restricted Area"');
        header('HTTP/1.0 401 Unauthorized');
    }
?>
