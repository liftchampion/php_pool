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
    function ft_str_pos($str) {
        $start = 0;
        if ($str[0] == '+' || $str[0] == '-') {
            $start++;
        }
        if (strlen($str) == $start) {
            return false;
        }
        for ($i = $start; $i < strlen($str); $i++) {
            if (strpos("+-*/%", $str[$i]) !== false) {
                return $i;
            }
        }
        return false;
    }
    function ft_is_numeric($str) {
        if (strpos($str, "x"))
            return false;
        if (!is_numeric($str))
            return false;
        return true;
    }
    function ft_split($line, $pos) {
        $ret = [];
        $ret[] = trim(substr($line, 0, $pos));
        $ret[] = trim($line[$pos]);
        $ret[] = trim(substr($line, $pos + 1));
        return $ret;
    }
    function ft_del_spaces($line) {
        $arr = str_split($line);
        $res = "";
        foreach ($arr as $chr) {
            if (strlen(trim($chr))) {
                $res .= $chr;
            }
        }
        return $line;
    }
    if (count($argv) != 2) {
        print ("Incorrect Parameters\n");
        exit(0);
    }
    $line = trim($argv[1]);
    $op_pos = ft_str_pos($line);
    if ($op_pos == false) {
        print ("Syntax Error\n");
        exit(0);
    }
    $params = ft_split($line, $op_pos);
    if (!ft_is_numeric($params[0]) || !ft_is_numeric($params[2])) {
        print ("Syntax Error\n");
        exit(0);
    }
    if (($params[1] == '/' || $params[1] == '%') && $params[2] == 0) {
        print ("Incorrect Parameters\n");
        exit(0);
    }
    print (calc($params[0], $params[1], $params[2])."\n");
