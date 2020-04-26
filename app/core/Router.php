<?php

namespace App\Core;

use App\Core\Exceptions;
use App\Core\Security;

class Router {

    private $route;
    public $request;
    public $response;
    public $service;

    public function __construct() {
        $this->route = new \Klein\Klein();
    }

    public function init() {
        $route = $this->route;
        $route->respond(function ($request, $response, $service) {
            $this->request_handler($request, $response, $service);
        });

        require_once(APP_PATH.'config/routes.php');

        $this->handle_error($route);
        $route->dispatch();
    }

    private function request_handler($request, $response, $service) {

        $this->request = $request;
        $this->response = $response;
        $this->service = $service;

        if (!in_array($request->uri(), config('csrf_except'))) {
            if ($request->method('post') || $request->method('put') || $request->method('delete')) {
                if (config('csrf_protection')) {
                    if (!Security::csrf_check()) {
                        Exceptions::csrf_error();   
                    }
                }
            }
        }
    }

    public function run($pattern, $request=NULL) {
        require_once(APP_PATH.'core/Functions.php');
        $segments = explode('@', $pattern);
        $controllerName = ucfirst(array_shift($segments));
        $this->request->controller_name = $controllerName;
        $controllerPath = 'app\controllers\\'.$controllerName.'Controller';
        
        try {
            $methodName = array_shift($segments);
            $this->request->method_name = $methodName;
            $controller = new $controllerPath();
            $controller->RUN($this->request, $this->response, $this->service);
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

    private function handle_error($route) {
        $route->onHttpError(function ($code, $router) {
            if ($code >= 400 && $code < 500) {
                Exceptions::error_page(404);
            } elseif ($code >= 500 && $code <= 599) {
                error_log('uhhh, something bad happened');
            }
        });
    }

    public function middleware($middlewareName) {
        $middlewarePath = 'app\middlewares\\'.$middlewareName;
        $middleware = new $middlewarePath();
        $middleware->RUN($this->request, $this->response, $this->service);
    }
}