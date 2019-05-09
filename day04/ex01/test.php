<?php
    $file = file_get_contents("../private/passwd");
    $data = unserialize($file);
    print_r($data);
    echo ".".$data[0]["login"].".\n";
    echo ".".$data[0]["loginll"].".\n";
