#!/usr/bin/env php
<?php
    function make_new_link($link) {
        $texts = [];
        $alts = [];
        $titles = [];
        $new_texts = [];
        $new_alts = [];
        $new_titles = [];
        $new_link = $link;
        preg_match_all("/[>]{1}[\s\S]*?[<]{1}/i", $link, $texts);
        preg_match_all("/alt[\s]*=[\s]*\"[\s\S]*?\"/i", $link, $alts);
        preg_match_all("/title[\s]*=[\s]*\"[\s\S]*?\"/i", $link, $titles);
        foreach ($texts[0] as $text) {
            $new_texts[] = strtoupper($text);
        }
        foreach ($alts[0] as $alt) {
            $pos = strpos($alt, "=");
            $first = substr($alt, 0, $pos + 1);
            $second = substr($alt, $pos + 1);
            $second = strtoupper($second);
            $new_alt = "".$first.$second;
            $new_alts[] = $new_alt;
        }
        foreach ($titles[0] as $title) {
            $pos = strpos($title, "=");
            $first = substr($title, 0, $pos + 1);
            $second = substr($title, $pos + 1);
            $second = strtoupper($second);
            $new_title = "".$first.$second;
            $new_titles[] = $new_title;
        }
        for ($i = 0; $i < count($new_texts); $i++) {
            $new_link = str_replace($texts[0][$i], $new_texts[$i], $new_link);
        }
        for ($i = 0; $i < count($new_alts); $i++) {
            $new_link = str_replace($alts[0][$i], $new_alts[$i], $new_link);
        }
        for ($i = 0; $i < count($new_titles); $i++) {
            $new_link = str_replace($titles[0][$i], $new_titles[$i], $new_link);
        }
        return $new_link;
    }
    if ($argc != 2) {
        exit(0);
    }
    $links = [];
    $file = file_get_contents($argv[1]);
    if ($file === false) {
        exit();
    }
    preg_match_all("/[<]{1}[\s]*[a]{1}[\s\S]*?[>]{1}[\s\S]*?[<]{1}[\s]*[\/]{1}[a]{1}[\s]*[>]{1}/i", $file, $links);
    foreach ($links[0] as $link) {
        $new_link = make_new_link($link);
        $file = str_replace($link, $new_link, $file);
    }
    print $file;