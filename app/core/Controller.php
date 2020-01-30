<?php

namespace App\Core;

abstract class Controller {

    public $route;
    public $view;

    public function __construct($route) {
        $this->route = $route;
    }
}