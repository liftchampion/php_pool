#!/usr/bin/env php
<?php
    function ft_split($line) {
        $ret = [];
        $arr = preg_split("/[\s]+/", $line);
        foreach ($arr as $value) {
            if (strlen($value)) {
                $ret[] = $value;
            }
        }
        return $ret;
    }
    if (count($argv) == 1) {
        exit(0);
    }
    $len = count($argv);
    $all_words = [];
    for ($i = 1; $i < $len; $i++){
        $all_words = array_merge($all_words, ft_split($argv[$i]));
    }
    sort($all_words);
    $res = "";
    foreach ($all_words as &$wd) {
        $res = $res.$wd."\n";
    }
    print($res);