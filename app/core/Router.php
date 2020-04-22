<?php

namespace App\Core;

use App\Core\Exceptions;

class Router {

    public $request;
    public $route;
    private $routeValue;
    private $routeService;

    public function __construct() {
        require_once(APP_PATH.'core/Functions.php');
        $this->route = new \Klein\Klein();
    }

    public function routes() {
        // require_once(APP_PATH.'config/routes.php');

        // foreach ($route as $key => $value) {

        //     $this->routeValue = $value;
        //     $this->route->respond('GET', $key, function ($request) {

        //         $this->run($this->routeValue, $request);
         
        //         // if(is_callable($this->routeValue)) {
        //         //     $fn = $this->routeValue;
        //         //     $fn();
        //         // }else {
        //         //     $this->run($this->routeValue, $request);
        //         // }
        //     });

        // }

        $this->route->respond('GET', "/", function ($request) {
            $this->run("welcome@index", $request);
        });

        $this->route->respond("/post", function ($request) {
            $this->run("welcome@post", $request);
        });
    }

    public function run($pattern, $request=NULL) {
        $segments = explode('@', $pattern);
        $controllerName = ucfirst(array_shift($segments));
        $this->request['controller_name'] = $controllerName;
        $controllerPath = 'app\controllers\\'.$controllerName.'Controller';
        
        try {
            $methodName = array_shift($segments);
            $this->request['method_name'] = $methodName;
            $this->normilizeParams($request);
            $controller = new $controllerPath();
            $controller->INIT($this->request);
            $methodArgs = ReflectionMethod($controller, $methodName);
            $argArr = [];
            foreach ($methodArgs as $value) {
                $argArr[] = $request->$value;
            }
            call_user_func_array([$controller, $methodName], $argArr);
        } catch (\Throwable $th) {
            echo $th;
            Exceptions::error_page(404);
        }
    }

    private function normilizeParams($request) {
        $this->request['url'] = $_SERVER['REQUEST_URI'];
        $this->request['cookies'] = $_COOKIE;
        $this->request['request_method'] = $_SERVER["REQUEST_METHOD"];
    }

    public function __destruct() {
        $this->route->dispatch();
    }
}