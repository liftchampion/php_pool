#!/usr/bin/env php
<?php
    function my_str_cmp($lhs, $rhs) {
        $my_ascii = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789
        \0\x1\x2\x3\x4\x5\x6\x7\x8\x9\xa\xb\xc\xd\xe\xf\x10\x11\x12\x13\x14\x15\x16\x17\x18\x19\x1a\x1b\x1c\x1d\x1e\x1f !\"#$%&'()*+,-./:;<=>?@[\]^_`{|}~\x7f";
        $i = 0;
        $j = 0;
        $lhs = strtoupper($lhs);
        $rhs = strtoupper($rhs);
        $len_l = strlen($lhs);
        $len_r = strlen($rhs);
        $lhs .= "A";
        $rhs .= "A";
        while ($i < $len_l && $j < $len_r && $lhs[$i] == $rhs[$j]) {
            $i++;
            $j++;
        }
        $pos1 = strpos($my_ascii, $lhs[$i]);
        $pos2 = strpos($my_ascii, $rhs[$j]);
        return (($pos1 - $pos2) >= 0);
    }
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
    usort($all_words, "my_str_cmp");
    $res = "";
    foreach ($all_words as &$wd) {
        $res = $res.$wd."\n";
    }
    print($res);