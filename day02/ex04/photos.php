#!/usr/bin/env php
<?php
    function grab_image($url, $saveto){
        if (($ch = curl_init ($url)) === false) {
            exit (0);
        }
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
        if (($raw = curl_exec($ch)) === false) {
            exit(0);
        }
        curl_close ($ch);
        if(file_exists($saveto)){
            unlink($saveto);
        }
        $fp = fopen($saveto,'x');
        if ((fwrite($fp, $raw)) === false) {
            exit (0);
        }
        fclose($fp);
    }
    if (!preg_match("/^(http|https):\/\//", $argv[1])) {
        $argv[1] = "http://".$argv[1];
    }
    if (($ch = curl_init($argv[1])) === false) {
        exit(0);
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    if (($html = curl_exec($ch)) === false || curl_error($ch)) {
        exit (0);
    }
    //print($html."\n");
    $url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    curl_close($ch);
    $imgs_tags = [];
    preg_match_all("/<[\s]*img[\s\S]*?>/", $html, $imgs_tags);
    $imgs_tags = $imgs_tags[0];
    $imgs = [];
    foreach ($imgs_tags as $tag) {
        $curr_imgs = [];
        preg_match_all("/[\s]+src[\s]*=[\s]*[\"'].*?[\"']/", $tag, $curr_imgs);
        foreach ($curr_imgs[0] as $img) {
            $imgs[] = preg_replace("/[\"']$/", "", preg_replace("/src[\s]*=[\s]*[\"']/", "", trim($img)));
        }
    }
    foreach ($imgs as &$img) {
        if (preg_match("/^http[s]?:\/\//", $img) == false) {
            if (preg_match("/^\//", $img) == false && preg_match("/\/$/", $url) == false) {
                $img = "/".$img;
            }
            if (preg_match("/^\//", $img) && preg_match("/\/$/", $url)) {
                $img = preg_replace("/^\//", "", $img);
            }
            $img = $url.$img;
        }
    }
    $dir_name = preg_replace("/^http[s]?:\/\//", "", $argv[1]);
    $dir_name = preg_replace("/\/$/", "", $dir_name);
    if (is_file($dir_name) || is_link($dir_name)) {
        exit (0);
    }
    if (is_dir($dir_name) == false) {
        if (mkdir($dir_name, 0755, true) == false) {
            exit(0);
        }
    }
    foreach ($imgs as &$imgg) {
        if (preg_match("/\.(jpg|jpeg|tif|tiff|png|gif|bmp|svg|webp|heic|heif|avif)$/", "")) {
            grab_image($imgg, $dir_name . "/" . basename($imgg));
        }
    }
