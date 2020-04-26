<?php

namespace App\Core;

use App\Core\Security;

class Input {

    public static function get($name) {
        $input = Security::xss_clean($_GET[$name]);
        if (isset($input)) {
            return $input;
        }
        return NULL;
    }

    public static function post($name) {
        $input = Security::xss_clean($_POST[$name]);
        if (isset($input)) {
            return $input;
        }
        return NULL;
    }

}