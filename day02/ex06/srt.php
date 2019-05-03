#!/usr/bin/env php
<?php
    function srt($lhs, $rhs) {
        if ($lhs["from"] != $rhs["from"]) {
            return ($lhs["from"] > $rhs["from"]);
        }
        return ($lhs["to"] >= $rhs["to"]);
    }
    if ($argc != 2) {
        exit(0);
    }
    if (file_exists($argv[1]) == false) {
        exit(0);
    }
    if (($file = file_get_contents($argv[1])) === false) {
        exit(0);
    }
    $lines = explode("\n", $file);
    $entrys = [];
    $in_entry = false;
    $curr_entry = [];
    $curr_entry["data"] = "";
    $numbers = [];
    foreach ($lines as $ln) {
        if ($ln == "") {
            $in_entry = false;
            $curr_entry["data"] = trim($curr_entry["data"]);
            $entrys[] = $curr_entry;
            $curr_entry = [];
            $curr_entry["data"] = "";
        }
        if ($in_entry) {
            if (preg_match("/[\d:,]{12} --> [\d:,]{12}/", $ln)) {
                $tm = explode(":", substr($ln, 0, strpos($ln, " --> ")));
                $curr_entry["from"] = $tm[0] * 3600 + $tm[1] * 60 + str_replace(",", ".", $tm[2]);
                $tm = explode(":", substr($ln, strpos($ln, " --> ") + 5));
                $curr_entry["to"] = $tm[0] * 3600 + $tm[1] * 60 + str_replace(",", ".", $tm[2]);
                $curr_entry["time"] = $ln;
            }
            else {
                $curr_entry["data"] .= $ln."\n";
            }
        }
        if (preg_match("/^[\d]$/", $ln)) {
            $in_entry = true;
            $numbers[] = $ln;
        }
    }
    for ($i = 0; $i < count($entrys); $i++) {
        if ($entrys[$i]["data"] == "" || $entrys[$i]["from"] == "" || $entrys[$i]["to"] == "" || $entrys[$i]["time"] == "") {
            unset($entrys[$i]);
        }
    }
    array_values($entrys);
    usort($entrys, "srt");
    $res = "";
    for ($i = 0; $i < count($entrys); $i++) {
        $res .= $numbers[$i]."\n";
        $res .= $entrys[$i]["time"]."\n";
        $res .= $entrys[$i]["data"]."\n\n";
    }
    print (trim($res)."\n");
