<?php

namespace App\Core;

use PDO;
use App\Core\Exceptions;

class Db
{

    private static $_db;
    public static $table;
    public static $query = '';
    public static $queryParams = [];
    private static $_instance = null;

    public function __construct()
    {
    }

    private static function connection()
    {
        if (self::$_db === null) {
            $config = require_once(APP_PATH . 'config/database.php');
            try {
                self::$_db = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'], $config['username'], $config['password']);
            } catch (\Throwable $th) {
                Exceptions::db_connect_error($th);
            }
        }

        return self::$_db;
    }

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }

    public static function table($table)
    {
        self::$table = $table . 's';
        return self::getInstance();
    }

    public static function select(...$argc)
    {
        self::$query .= 'SELECT ';
        self::$query .= count($argc) > 0 ? implode(", ", $argc) : '*';
        self::$query .= " FROM ".self::$table;
        return self::getInstance();
    }

    public static function where(string $key, string $condition, string $value)
    {
        self::$query .= " WHERE $key $condition $value";
        return self::getInstance();
    }

    public function get()
    {
        // return $this->row('SELECT * FROM ' . self::$table);
        return self::$query;
    }

    public static function query($sql, $params = [])
    {
        $stmt = self::connection()->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                $stmt->bindValue(':' . $key, $value);
            }
        }
        $stmt->execute();
        return $stmt;
    }

    public static function row($sql, $params = [])
    {
        $result = self::query($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}
