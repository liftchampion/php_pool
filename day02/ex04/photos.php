#!/usr/bin/env php
<?php
    function grab_image($url, $dir, $name){
        if (($ch = curl_init ($url)) === false) {
            return;
        }
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
        if (($raw = curl_exec($ch)) === false) {
            return;
        }
        curl_close ($ch);
        if(file_exists($dir.$name)){
            unlink($dir.$name);
        }

        if (($fp = fopen($dir.$name,'x')) === false) {
            return;
        }
        if ((fwrite($fp, $raw)) === false) {
            return;
        }
        fclose($fp);
    }
    if (!preg_match("/^(http|https):\/\//i", $argv[1])) {
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
    $url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    curl_close($ch);
    $imgs_tags = [];
    preg_match_all("/<[\s]*img[\s\S]*?>/i", $html, $imgs_tags);
    $imgs_tags = $imgs_tags[0];
    $imgs = [];
    foreach ($imgs_tags as $tag) {
        $curr_imgs = [];
        preg_match_all("/[\s]+src[\s]*=[\s]*[\"'].*?[\"']/i", $tag, $curr_imgs);
        foreach ($curr_imgs[0] as $img) {
            $imgs[] = preg_replace("/[\"']$/i", "", preg_replace("/src[\s]*=[\s]*[\"']/i", "", trim($img)));
        }
    }
    foreach ($imgs as &$img) {
        if (preg_match("/^http[s]?:\/\//i", $img) == false) {
            if (preg_match("/^\//i", $img) == false && preg_match("/\/$/i", $url) == false) {
                $img = "/".$img;
            }
            if (preg_match("/^\//i", $img) && preg_match("/\/$/i", $url)) {
                $img = preg_replace("/^\//i", "", $img);
            }
            $img = $url.$img;
        }
    }
    $dir_name = preg_replace("/^http[s]?:\/\//i", "", $argv[1]);
    $dir_name = preg_replace("/\/$/i", "", $dir_name);
    if (is_file($dir_name) || is_link($dir_name)) {
        exit (0);
    }
    if (is_dir($dir_name) == false) {
        if (mkdir($dir_name, 0755, true) == false) {
            exit(0);
        }
    }
    foreach ($imgs as &$imgg) {
        if (preg_match("/\.(jpg|jpeg|tif|tiff|png|gif|bmp|svg|webp|heic|heif|avif)$/", $imgg)) {
            grab_image($imgg, $dir_name."/" , basename($imgg));
        }
    }
