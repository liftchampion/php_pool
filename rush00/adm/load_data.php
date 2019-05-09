<?php
include "json.php";
function load_data($catname)
{
    $file = get_json("goods");
    print($catname);
    if ($catname == "all")
        return $file;
    else
    {
        $tmp = array();
        foreach ($file as $key => $value)
        {
            if ($value["cat"] == $catname)
                $tmp[] = $file[$key];
        }
        return ($tmp);
    }
}
function load_data2($catname)
{
    $file = get_json_path("db/goods.json");
    //print($catname);
    if ($catname == "all")
        return $file;
    else
    {
        $tmp = array();
        foreach ($file as $key => $value)
        {
            if (in_array($catname, $value["cat"]))
                $tmp[] = $file[$key];
        }
        return ($tmp);
    }
}
?>