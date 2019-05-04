<?php
    session_start();
    $log = $_GET["login"];
    $pass = $_GET["passwd"];
    if ($log != "" && $pass != "") {
        $_SESSION["login"] = $log;
        $_SESSION["passwd"] = $pass;
    }
    else {
        $log = $_SESSION["login"];
        $pass = $_SESSION["passwd"];
    }
?>
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
<h2>Login</h2>
<form method="get">
	Username: <input type="text" name="login" value="<?php echo $log; ?>">
	<br />
	Password: <input type="password" name="passwd" value="<?php echo $pass; ?>">
	<input type="submit" name="submit" value="OK">
</form>
</body>
</html>
