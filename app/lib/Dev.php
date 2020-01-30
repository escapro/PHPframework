<?php

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    function debugg($str, $exit=true) {
        echo "<pre>";
        var_dump($str);
        echo "</pre>";
        if($exit) {
            exit();
        }
    }