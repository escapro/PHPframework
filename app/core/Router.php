<?php

namespace App\Core;

class Router {

    protected $routes = [];
    public $url = '';
    protected $query = [];
    protected $params = [];

    function __construct() {
        $this->routes = require_once(APP_PATH.'config/routes.php');
    }

    private function getUri() {

        if (!empty($_SERVER['REQUEST_URI'])) {

            $uri = parse_url($_SERVER['REQUEST_URI']);
            $uri['path'] = trim($uri['path'], '/');
            ($uri['path'] == '') ? $uri['path'] = '/' : '';

            return $uri;
        }
    }

    private function match() {

        $uri = $this->getUri();

        $this->uri = $uri['path'];

        if (isset( $uri['query']) ) {
            parse_str($uri['query'], $output);
            $this->query = $output;
        }
        
        return $this->uri;
    }

    public function run() {

        $uri = $this->match();
        $result = false;
        
        foreach ($this->routes as $pattern => $path) {
            if(preg_match("~$pattern~", $uri)) {
                $segments = explode('/', $path);
                $controllerName = ucfirst(array_shift($segments));
                $this->params['controller'] = $controllerName;
                $controllerPath = 'app\controllers\\'.$controllerName.'Controller';
                $result = true;
                if(class_exists($controllerPath)) {
                    $actionName = array_shift($segments);
                    $this->params['action'] = $actionName;
                    if(method_exists($controllerPath, $actionName)) {
                        $params = $segments;
                        $controller = new $controllerPath($this->params);
                        $controller->$actionName();
                    }else {
                        $result = false;
                    }
                }else {
                    $result = false;
                }
            }
            
        }

        if (!$result) {
            Exceptions::error_page(404);
        }
    }
   
}
