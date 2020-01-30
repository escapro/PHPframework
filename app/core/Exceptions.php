<?php

namespace App\Core;

use App\Core\View;

class Exceptions {

    public static function error_page($code) {
        http_response_code($code);
        View::render('errors/'.$code);
        exit();
    }
    
    public static function db_connect_error($e) {
        echo "Не удалось подключиться к базе данных <br>";
        echo "Причина: ".$e;
        exit();
    }
}