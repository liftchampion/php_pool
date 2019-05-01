<?php
    function ft_is_sort($arr) {
        $arr_sorted1 = $arr;
        $arr_sorted2 = $arr;
        sort($arr_sorted1);
        rsort($arr_sorted2);
        if ($arr == $arr_sorted1 || $arr == $arr_sorted2) {
            return true;
        }
        return false;
    }