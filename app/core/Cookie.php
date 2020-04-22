<?php

namespace App\Core;

use App\Libs\Date;

class Cookie {

    public static function put($cookie_name, $cookie_value, $expire=NULL, $path=NULL) {
        if(!$expire) $expire = config('cookie_expire');
        if(!$path) $path = config('cookie_path');
        setcookie($cookie_name, $cookie_value, $expire, $path);
    }

    public static function delete($name) {
        setcookie($name, "", time() - 3600*24*30*12*10);
    }

    public static function get($name) {
        if(isset($_COOKIE[$name])) return $_COOKIE[$name];
        return NULL;
    }
}