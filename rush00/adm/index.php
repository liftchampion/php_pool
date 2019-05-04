<?php
    if (!session_start()) {
        echo "ERROR\n";
        exit(0); // fixme session error
    }
    $is_adm = $_SESSION["is_adm"];
    $log = $_SESSION["log"];
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
<?php
    if ($log != "") {
        echo "<h2>Logged as {$log}</h2>";
    }
    else {
        echo "<h2>Login</h2>";
    }
?>
<form name="login.php" action="login.php" method="post">
    Username: <input type="text" name="login" value="">
    <br />
    Password: <input type="password" name="passwd" value="">
    <input type="submit" name="submit" value="OK">
</form>
<a href="create.html">Register account</a>
<br />
<?php
    if ($is_adm) {
        echo '<a href="adm.php">Adm area</a>';
    }
    else if ($log != "") {
        echo '<a href="adm.php">User info</a>';
    }
    if ($log != "") {
        echo '<br /><a href="logout.php">Logout</a>';
    }
?>
</body>
</html>