<?php
    if ($_SERVER['PHP_AUTH_USER'] == null) {
        header('WWW-Authenticate: Basic realm="Member area"');
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
        header("Date: Tue, 26 Mar 2013 09:42:42 GMT");
        header('WWW-Authenticate: Basic realm="Member area"');
        header('HTTP/1.0 401 Unauthorized');
        header("Content-Length: 72");
        header("Connection: close");
        echo <<<EOT
<html><body>That area is accessible for members only</body></html>     

EOT;
    }
?>
