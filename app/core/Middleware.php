<?php

namespace App\Core;

abstract class Middleware
{
    public $request;
    public $response;
    public $service;

    abstract function handle();
    public function RUN($request, $response, $service) {
        $this->request = $request;
        $this->response = $response;
        $this->service = $service;
        $this->handle();
    }
}
