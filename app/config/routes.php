<?php

namespace App\Core;

$route->respond('GET', '/', function () {
    $this->middleware('CheckAge');
    $this->run('welcome@index');
});

$route->respond('POST', '/post', function ($request) {
    var_dump(Input::post('q'));
});

$route->respond('GET', '/qwe', function ($request, $response) {
	$obj = [
		"names" => [
			"Peter"=>35,
			"Ben"=>37,
			"Joe"=>43
		]
	];
	
	$send = $request->param('format', 'json');
    $response->$send($obj);
});