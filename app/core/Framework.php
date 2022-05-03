<?php

require_once BASE_PATH. 'vendor/autoload.php';

spl_autoload_register(function($class) {
    $class = explode('\\', $class);
    for ($i=0; $i < sizeof($class); $i++) { 
        if($i != sizeof($class) - 1) {
            $class[$i] = strtolower($class[$i]);
        }
    }
    $class = implode('\\', $class);
    $path = BASE_PATH.str_replace('\\', '/', $class.'.php');
    if (file_exists($path)) {
        require_once($path);
    }else {
        exit("Класс (".$class.") не найден");
    }
});

function load_helper($helper) {
    $file = APP_PATH.'helpers/'.$helper.'.php';
    if (file_exists($file)) {
        require_once($file); 
    }else {
        exit("Файл (".$helper.") не найден");
    }
}

$helpers_autoload = require(APP_PATH.'config/helpers_autoload.php');
if (isset($helpers_autoload)) {
    if (!empty($helpers_autoload)) {
        foreach ($helpers_autoload as $helper) {
            load_helper($helper);
        }
    }
}
unset($helpers_autoload);

date_default_timezone_set(config('default_timezone'));

$router = new App\Core\Router();
$router->init();