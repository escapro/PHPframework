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

    public static function csrf_error() {
        echo "Не удалось проверить CSRF токен";
        exit();
    }

    public static function file_not_found($path) {
        echo "Не удалось найти файл по пути: ". $path;
        exit();
    }
}