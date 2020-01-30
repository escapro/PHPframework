<?php

use App\Core\Router;

spl_autoload_register(function($class) {
    $path = BASE_PATH.str_replace('\\', '/', $class.'.php'); 
    if (file_exists($path)) {
        require_once($path);
    }
});

$libs = array(
    'Dev',
    'View'
);

foreach ($libs as $lib) {
    $path = APP_PATH.'lib/'.$lib.'.php';
    if(file_exists($path)){
        require_once($path);
    }
}

$router = new Router();
$router->run();