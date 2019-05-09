<?php
include("load_data.php");
$tmp = load_data("all");
//print_r($tmp);
foreach ($tmp as $key)
{
    echo "</head><body>";
    echo "<div style='font-size: 3vw' class='item'>";
    echo ("$key[name]" . "<br /><img src='../img/$key[name].jpg'><br />" . "$key[price]\n");
    echo "</div>";
    echo "</div></body></html>";
};
?>