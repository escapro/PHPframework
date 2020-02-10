<?php

namespace App\Core;

class Router {

    public $params;
    public $route;

    public function __construct() {
        require_once(APP_PATH.'core/Functions.php');
        $this->route = new \Klein\Klein();
    }

    public function routes() {

        $this->route->respond('GET', '/', function () {
            $this->run('welcome@index',);
        });
    }

    public function run($pattern, $request=NULL) {
        $segments = explode('@', $pattern);
        $controllerName = ucfirst(array_shift($segments));
        $this->params['controller'] = $controllerName;
        $controllerPath = 'app\controllers\\'.$controllerName.'Controller';
        
        try {
            $methodName = array_shift($segments);
            $this->params['method'] = $methodName;
            $controller = new $controllerPath($request);
            $methodArgs = ReflectionMethod($controller, $methodName);
            $argArr = [];
            foreach ($methodArgs as $value) {
                $argArr[] = $request->$value;
            }
            call_user_func_array([$controller, $methodName], $argArr);
        } catch (\Throwable $th) {
            Exceptions::error_page(404);
        }
    }

    public function __destruct() {
        $this->route->dispatch();
    }
}