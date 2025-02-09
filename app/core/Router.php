<?php

namespace App\Core;

class Router {
    private $routes = [];

    public function __construct() {
        $this->routes = [
            '/' => 'UserController@index',
            '/login' => 'UserController@login',
            '/register' => 'UserController@register',
            '/playlist/create' => 'PlaylistController@create',
            '/song/play' => 'SongController@play'
        ];
    }

    public function run() {
        $uri = trim($_SERVER['REQUEST_URI'], '/');
        if (array_key_exists($uri, $this->routes)) {
            $action = explode('@', $this->routes[$uri]);
            $controllerName = 'App\\Controllers\\' . $action[0];
            $method = $action[1];

            if (class_exists($controllerName)) {
                $controller = new $controllerName();
                if (method_exists($controller, $method)) {
                    call_user_func([$controller, $method]);
                } else {
                    echo "Method not found!";
                }
            } else {
                echo "Controller not found!";
            }
        } else {
            echo "404 Not Found";
        }
    }
}
