#!/usr/bin/env php
<?php
    function calc($a1, $op, $a2) {
        if ($op == '+') {
            return ($a1 + $a2);
        }
        if ($op == '-') {
            return ($a1 - $a2);
        }
        if ($op == '*') {
            return ($a1 * $a2);
        }
        if ($op == '/') {
            return ($a1 / $a2);
        }
        if ($op == '%') {
            return ($a1 % $a2);
        }
        return (0);
    }
    if (count($argv) != 4) {
        print ("Incorrect Parameters\n");
        exit(0);
    }
    $a1 = trim($argv[1]);
    $op = trim($argv[2]);
    $a2 = trim($argv[3]);
    print (calc($a1, $op, $a2)."\n");
