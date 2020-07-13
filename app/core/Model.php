<?php

namespace App\Core;

use App\Core\Db;

abstract class Model {

    public $db;
    public $table;

    public function __construct()
    {
        $this->db = new Db();
    }

    public function select_all(String $table){
        return $this->db->row('SELECT * FROM '.$table);
    }

    public function select(Array $rows, String $table){
        $query = 'SELECT';
        foreach ($rows as $key => $value) {
            $query .= ' '.$value;
            $query .= $value !== end($rows) ? ', ' : ' ';
        }
        $query .= 'FROM '.$table;
        return $this->db->row($query);
    }
}