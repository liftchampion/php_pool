#!/usr/bin/php
<?php
    if (count($argv) != 2) {
        exit(0);
    }
    $word_w_trash = preg_split("/[ ]/", $argv[1]);
    $words = [];
    foreach ($word_w_trash as $value) {
        if (strlen($value)) {
            $words[] = $value;
        }
    }
    $res = "";
    foreach ($words as $wd) {
        $res = $res." ".$wd;
    }
    $res = trim($res);
    print($res."\n");