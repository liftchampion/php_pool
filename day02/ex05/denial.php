#!/usr/bin/env php
<?php
    if ($argc != 3) {
        exit(0);
    }
    $nm = $argv[1];
    $key = $argv[2];
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
//    print_r($keys);
//    print_r($data);
    foreach ($keys as $k) {
        $$k = [];
//        print ("-----".$k."-----\n");
        foreach ($data as $val) {
//            print ($val[array_search($k, $keys)]."\n");
            ${$k}[$val[$key_key]] = $val[array_search($k, $keys)];
        }
        //print_r($$k);
    }
    $f = fopen( 'php://stdin', 'r' );
    print ("Enter your command: ");
    while($line = fgets($f)) {
        eval(trim($line));
        print ("Enter your command: ");
    }
    print ("^D\n");
    //fopen()
    //while ()