<?php

namespace App\Core;

class Session{

    public function __construct() {
        self::init();
    }

    public static function init() {
        session_name(config('session_name'));
        session_start();
    }
    
    public static function put($name, $value) {
        $_SESSION[$name] = $value;
    }

    public static function get($name) {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];   
        }

        return NULL;
    }

    public static function forget($name) {
        unset($_SESSION[$name]);
    }

    public static function flush() {
        session_unset();
        session_destroy();
    }

    public static function pull($name) {
        $s = self::get($name);
        self::forget($name);
        return $s;
    }

}