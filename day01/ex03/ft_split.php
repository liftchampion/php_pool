<?php
    function ft_split($line) {
        $ret = [];
        $arr = array_unique(preg_split("/[\s]+/", $line));
        foreach ($arr as $value) {
            if (strlen($value)) {
                $ret[] = $value;
            }
        }
        sort($ret);
        return $ret;
    }