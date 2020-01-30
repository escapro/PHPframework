<?php

    // Класс авторизации
    class Auth {

        public $is_login;

        // Возвращает true если ползователь залогинен, false если нет
        public function __construct() {

            $this->is_login = false;

            // Проверка на наличие куки is_login
            if(isset($_COOKIE['is_login'])) {
                $this->is_login = true;
            }
            return $this->is_login;
        }
        
    }
?>