<?php

namespace App\Core;

use App\Core\Dev;
use App\Core\Security;
use App\Core\Session;
use App\Core\Exceptions;

abstract class Controller {

    public $request;

    public function INIT($request) {
        $this->request = $request;
        Session::init();
        Security::init();
        $this->CHECK_REQUEST();
        // $args = func_get_args();
    }

    public function CHECK_REQUEST() {
        if (!in_array($this->request['url'], config('csrf_except'))) {
            if ($this->request['request_method'] == "POST" || $this->request['request_method'] == "PUT" || $this->request['request_method'] == "DELETE") {
                if (config('csrf_protection')) {
                    if (!Security::csrf_check()) {
                        Exceptions::csrf_error();   
                    }
                }
            }
        }
    }
}