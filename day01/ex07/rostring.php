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
    $len = count($all_words);
    if ($len ==  0) {
        exit(0);
    }
    if ($len ==  1) {
        print ($all_words[0]."\n");
        exit(0);
    }
    $all_words[$len - 1] = $all_words[0];
    array_shift($all_words);
    $res = "";
    foreach ($all_words as $value) {
        $res = $res.$value." ";
    }
    $res = trim($res);
    print($res."\n");
