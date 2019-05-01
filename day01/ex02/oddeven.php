#!/usr/bin/php
<?php
    function checkValid($str) {
        $start = 0;
        if ($str[0] == '-' || $str[0] == '+') {
            $start++;
        }
        if (strlen($str) == $start)
            return false;
        for ($i = $start; $i < strlen($str); $i++) {
            if (!($str[$i] >= '0' && $str[$i] <= '9')) {
                return false;
            }
        }
        return true;
    }
    print("Enter a number: ");
    $stdin = fopen('php://stdin', 'r');
    $line = fgets($stdin);
    if (!strlen($line)) {
        print ("^D\n");
        exit(0);
    }
    $line = substr($line, 0, -1);
    if (!checkValid($line)) {
        print ("'".$line."'"." is not a number\n");
        exit(0);
    }
    print ("The number ".$line." is ");
    if ($line[strlen($line) - 1] % 2) {
        print ("odd\n");
    }
    else {
        print ("even\n");
    }