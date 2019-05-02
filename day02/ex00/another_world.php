#!/usr/bin/env php
<?php
    function ft_split($line) {
        $ret = [];
        $arr = preg_split("/[ \t]+/", $line);
        foreach ($arr as $value) {
            if (strlen($value)) {
                $ret[] = $value;
            }
        }
        return $ret;
    }
    if ($argc == 1) {
        exit(0);
    }
    $words = ft_split($argv[1]);
    print(implode(" ", $words) . "\n");
