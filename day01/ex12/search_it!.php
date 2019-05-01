#!/usr/bin/env php
<?php
    $len = count($argv);
    if ($len <= 2) {
        exit(0);
    }
    $map = [];
    $key = $argv[1];
    for ($i = 2; $i < $len; $i++) {
        $pos = strpos($argv[$i], ":");
        $k = substr($argv[$i], 0, $pos);
        if ($pos != strlen ($argv[$i])) {
            $v = substr($argv[$i], $pos + 1);
        }
        else {
            $v = "";
        }
        $map[$k] = $v;
    }
    if (strlen($map[""]) == 0) {
        unset($map[""]);
    }
    if (array_key_exists($key, $map)) {
        print($map[$key]."\n");
    }
