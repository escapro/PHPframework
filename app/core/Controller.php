<?php

namespace App\Core;

use App\Core\Dev;
use App\Core\Security;
use App\Core\Session;
use App\Core\Exceptions;

abstract class Controller {

    public $request;
    public $response;
    public $service;

    public function RUN($request, $response, $service) {
        $this->request = $request;
        $this->response = $response;
        $this->service = $service;
        Session::init();
        Security::init();
    }
}