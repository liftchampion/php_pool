<?php
    if (!session_start()) {
        echo "ERROR\n";
        exit(0); // fixme session error
    }
    if (!$_SESSION["is_adm"]) {
        header("Location: index.php");
        exit(0);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<h2 class="adm_title">Rm user</h2>
<form action="rm_user.php" method="post">
    Login: <input type="text" name="log_to_rm" value="">
    <input type="submit" value="RM">
</form>
<?php
    if ($_SESSION["last_query"] == "rm_user" && $_SESSION["query_msg"] != "") {
        echo "<p class='adm_texts'>{$_SESSION["query_msg"] }</p>\n";
    }
?>
<h2 class="adm_title">Adm user</h2>
<form action="adm_user.php" method="post">
    Login: <input type="text" name="log_to_adm" value="">
    <input type="submit" value="RM">
</form>
<?php
    if ($_SESSION["last_query"] == "adm_user" && $_SESSION["query_msg"] != "") {
        echo "<p class='adm_texts'>{$_SESSION["query_msg"] }</p>\n";
    }
?>
<?php
    $_SESSION["last_query"] = "";
    $_SESSION["query_msg"] ="";
?>
</body>
</html>