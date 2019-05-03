#!/usr/bin/env php
<?php
    $bin = file_get_contents("/var/run/utmpx");
    if ($bin === false) {
        exit();
    }
    $i = 0;
    $len = strlen($bin);
    date_default_timezone_set("Europe/Moscow");
    while ($i < $len) {
        $sub = substr($bin, $i, $i + 628);
        $parsed = unpack("a256user/a4id/a32line/ipid/itype/Itvt/Itvs/a256host/a64pad", $sub);
        $date = date("j", $parsed["tvt"]);
        if (strlen($date) == 1) {
            $date = " ".$date;
        }
        $date = date("F", $parsed["tvt"])." ".$date." ".date("H:i", $parsed["tvt"]);
        if ($parsed["type"] == 7) {
            print ($parsed["user"]." ".$parsed["line"]."  ".$date."\n");
        }
        $i += 628;
    }


