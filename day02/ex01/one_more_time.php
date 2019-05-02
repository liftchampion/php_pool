#!/usr/bin/env php
<?php
    function check_dow($d) {
        if (preg_match("/^([Ll]undi|[Mm]ardi|[Mm]ercredi|[Jj]eudi|[Vv]endredi|[Ss]amedi|[Dd]imanche)$/", $d)) {
            return true;
        }
        return false;
    }
    function check_date($d) {
        if (preg_match("/^[0-9]{1,2}$/", $d)) {
            return ($d != 0 ? true : false);
        }
        return false;
    }
    function check_month($m) {
        if (preg_match("/^([Jj]anvier|[Ff](e|é)vrier|[Mm]ars|[Aa]vril|[Mm]ai|[Jj]uin|[Jj]uillet|".
            "[Aa]o(u|û)t|[Ss]eptembre|[Oo]ctobre|[Nn]ovembre|[Dd](e|é)cembre)$/", $m)) {
            return true;
        }
        return false;
    }
    function check_year($y) {
        if (preg_match("/^[0-9]{4}$/", $y)) {
            return (true);
        }
        return false;
    }
    function check_time($t) {
        if (preg_match("/^[0-9]{2}[:][0-9]{2}[:][0-9]{2}$/", $t)) {
            return (true);
        }
        return false;
    }
    if ($argc != 2) {
        exit(0);
    }
    setlocale(LC_TIME, "fr_FR");
    date_default_timezone_set("Europe/Paris");
    $words = preg_split("/[ ]{1}/", $argv[1]);
    if (count($words) != 5 ||
        !check_dow($words[0]) || !check_date($words[1]) || !check_month($words[2]) ||
        !check_year($words[3]) || !check_time($words[4])) {
        print ("Wrong Format\n");
        exit(0);
    }
    $line = $argv[1];
    $line = preg_replace("/[Dd]ecembre/", "décembre", $line);
    $line = preg_replace("/[Aa]out/", "août", $line);
    $line = preg_replace("/[Ff]evrier/", "février", $line);
    $frmt_dom = strlen($words[1]) == 1 ? "%e" : " %d";
    $date = strptime($line, "%A".$frmt_dom." %B %Y %H:%M:%S");
    if ($date === false || checkdate($date["tm_mon"] + 1, $date["tm_mday"], 1900 + $date["tm_year"]) == false) {
        print ("Wrong Format\n");
        exit(0);
    }
    $unixtime = mktime($date["tm_hour"], $date["tm_min"], $date["tm_sec"],
        $date["tm_mon"] + 1, $date["tm_mday"], $date["tm_year"] + 1900);
    $dow = $date["tm_wday"];
    $dow = $dow == 0 ? 7 : $dow;
    if ($dow != date("N", $unixtime)) {
        print ("Wrong Format\n");
        exit(0);
    }
    print ($unixtime."\n");