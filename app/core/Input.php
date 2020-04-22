<?php

namespace App\Core;

class Input {

    public static function get($name) {
        if (isset($_GET[$name])) {
            return $_GET[$name];
        }
        return NULL;
    }

    public static function post($name) {
        if (isset($_POST[$name])) {
            return $_POST[$name];
        }
        return NULL;
    }

}