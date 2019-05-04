<?php
    function get_json($name) {
        if (!file_exists("../db/{$name}.json")) {
            exit (0); // fixme no json
        }
        $file = file_get_contents("../db/{$name}.json");
        if ($file === false) {
            exit(0); // fixme read file error
        }
        if (($data = json_decode($file, true)) == FALSE){
            exit (0); //fixme json error
        }
        return $data;
    }
    function set_json($data, $name){
        if (($encoded = json_encode($data)) === FALSE) {
            echo "ERROR\n";
            exit(0); // fixme json error
        }
        if (!file_put_contents("../db/{$name}.json", $encoded)) {
            echo "ERROR\n";
            exit(0); //fixme put error
        }
}
