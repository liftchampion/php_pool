#!/usr/bin/env php
<?php
    if ($argc != 3) {
        exit(0);
    }
    $nm = $argv[1];
    $key = $argv[2];
    if (file_exists($nm) == false) {
        exit(0);
    }
    if (($fd = fopen($nm, 'r')) === false) {
        exit(0);
    }
    if (($keys = fgetcsv($fd, 0, ";")) == false) {
        exit(0);
    }
    if (($key_key = array_search($key, $keys)) === false) {
        exit (0);
    }
    $data = [];
    while ($vals = fgetcsv($fd, 0, ";")) {
        $data[] = $vals;
    }
    foreach ($keys as $k) {
        $$k = [];
        foreach ($data as $val) {
            ${$k}[$val[$key_key]] = $val[array_search($k, $keys)];
        }
    }
    $f = fopen( 'php://stdin', 'r' );
    print ("Enter your command: ");
    while($line = fgets($f)) {
        $line = str_replace("/^rm /", "", $line);
        eval($line);
        print ("Enter your command: ");
    }
    print ("^D\n");