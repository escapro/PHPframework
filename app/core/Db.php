<?php

namespace App\Core;

use PDO;
use App\Core\Exceptions;

class Db {

    protected $db;

    public function __construct()
    {
        $config = require_once(APP_PATH.'config/database.php');
        try {
            $this->db = new PDO('mysql:'.$config['host'].'=localhost;dbname='.$config['dbname'], $config['username'], $config['password']);
        } catch (\Throwable $th) {
            Exceptions::db_connect_error($th);
        }
    }

    public function query($sql, $params = [])
    {
        $stmt = $this->db->prepare($sql);
        if(!empty($params)){
            foreach ($params as $key => $value) {
                $stmt->bindValue(':'.$key, $value);
            }
        }
        $stmt->execute();
        return $stmt;
    }

    public function row($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}