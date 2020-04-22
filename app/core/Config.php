<?php

namespace App\Core;

class Config {

    public static function get($name)
    {
        $config = require(APP_PATH.'config/config.php');
        return $config[$name];
    }
}