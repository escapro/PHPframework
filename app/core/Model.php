<?php

namespace App\Core;

use App\Lib\Db;

abstract class Model {

    public $db;

    public function __construct()
    {
        $this->db = new Db();
    }
}