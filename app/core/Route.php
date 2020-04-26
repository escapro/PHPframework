<?php

namespace App\Core;

use App\Core\Router;
use App\Core\Security;
use App\Core\Exceptions;

class Route{

    public $route;
    public $router;

    public function __construct() {
        /** eval('namespace App\Core {?>'.file_get_contents(APP_PATH.'config/routes.php').'}'); */
        // $this->route = new \Klein\Klein();
        $this->router = new Router();
    }

    public function get($path, $param) {
        $GLOBALS['param'] = $param;
        $GLOBALS['path'] = $path;

        if (strlen($path) > 1) {
            if ($path[0] !== '/') {
                $path = '/'.$path;
            }
        }

        // self::handle_error($klein);

        $this->route->respond('GET', $GLOBALS['path'], function ($request) {
            echo "dsf";
            // if (is_callable($GLOBALS['param'])) {
            //     $GLOBALS['param']($request);
            // }else {
            //     $this->router->run($GLOBALS['param']);
            // }
            // unset($GLOBALS);
        });
        $this->route->dispatch();
    }

    // private static function match($methods, $path, $param) {
    //     $klein = new \Klein\Klein();
    //     $GLOBALS['param'] = $param;
    //     $GLOBALS['methods'] = $methods;

    //     if (strlen($path) > 1) {
    //         if ($path[0] !== '/') {
    //             $path = '/'.$path;
    //         }
    //     }

    //     $klein->respond($methods, $path, function ($request) {
    //         $router = new Router();
    //         if ($_SERVER["REQUEST_METHOD"] == "POST" || $_SERVER["REQUEST_METHOD"] == "PUT" || $_SERVER["REQUEST_METHOD"] == "DELETE" || $_SERVER["REQUEST_METHOD"] == "OPTIONS") {
    //             self::check_csrf();
    //         }
    //         if (is_callable($GLOBALS['param'])) {
    //             return $GLOBALS['param']($request);
    //         }else {
    //             $router->run($GLOBALS['param']);
    //         }
    //         unset($GLOBALS);
    //     });

    //     $klein->dispatch();
    // }

    private static function check_csrf() {
        if (!in_array($_SERVER['REQUEST_URI'], config('csrf_except'))) {
            if (config('csrf_protection')) {
                if (!Security::csrf_check()) {
                    Exceptions::csrf_error();   
                }
            }
        }
    }

    private static function handle_error($klein) {
        $klein->onHttpError(function ($code, $router) {

            if ($code == 404) {
                $router->response()->body(
                    Exceptions::error_page(404)
                );
            }
        });
    }
}