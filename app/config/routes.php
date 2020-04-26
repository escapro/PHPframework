<?php

namespace App\Core;

$route->respond('GET', '/', function () {
    $this->middleware('CheckAge');
    $this->run('welcome@index');
});

$route->respond('POST', '/post', function ($request) {
    var_dump(Input::post('q'));
});