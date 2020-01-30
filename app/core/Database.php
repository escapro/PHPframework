<?php

    // Класс для работы с базой данных
    class Db {

        // Подключение к базе данных
        public static function connect() {
            
            // Получить массив с конфигурацией для подключения к базы данных
            $database = include('config/database.php');

            // Выполнить подключение к базе данных и вернуть объект подключения в случае успеха
            try {
                $db = new PDO("mysql:host=".$database["servername"].";dbname=".$database['dbname'], $database['username'], $database['password']);
                return $db;
            }
            catch (PDOException $e) {
                exit("Ошибка при подключении к базе данных:<br>".$e);
            }

        }
    }
?>