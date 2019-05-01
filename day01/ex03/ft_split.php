<?php
    function ft_split($line) {
        $ret = [];
        $arr = preg_split("/[\s]+/", $line);
        foreach ($arr as $value) {
            if (strlen($value)) {
                $ret[] = $value;
            }
        }
        sort($ret);
        return $ret;
    }
