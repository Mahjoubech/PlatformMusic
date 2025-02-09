<?php
namespace App\Routes;

class Router {
    private $routes = [];

    public function add(string $method, string $path, $handler) {
        $this->routes[$method][$path] = $handler;
    }

    public function dispatch(string $method, string $uri) {
        if (isset($this->routes[$method][$uri])) {
            $handler = $this->routes[$method][$uri];
            if (is_array($handler)) {
                [$controller, $action] = $handler;
                $controller = new $controller();
                $controller->$action();
            } else {
                $handler();
            }
            return;
        }
        
        // Handle 404
        header("HTTP/1.0 404 Not Found");
        require_once 'views/404.php';
    }
}
