<?php

namespace App\Core;

use App\Core\DB;

abstract class Model
{

    public $db;
    public static $table_name;

    public static function all()
    {
        return DB::row('SELECT * FROM ' . self::getTableName());
    }

    private static function getTableName()
    {
        return strtolower(end(explode('\\', get_called_class()))) . 's';
    }

    // public function select(array $rows, String $table_name)
    // {
    //     $query = 'SELECT';
    //     foreach ($rows as $key => $value) {
    //         $query .= ' ' . $value;
    //         $query .= $value !== end($rows) ? ', ' : ' ';
    //     }
    //     $query .= 'FROM ' . $table_name;
    //     return $this->db->row($query);
    // }
}
