<?php

namespace App\Core;


class Route
{
    static function distribute(): void
    {
        $controllerName = 'Main';
        $actionName = 'index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        if (!empty($routes[1])) {
            $controllerName = $routes[1];
        }

        if (!empty($routes[2])) {
            $actionName = $routes[2];
        }

        $controllerName = ucwords($controllerName) . 'Controller';
        $controllerClass = "App\\Controllers\\" . $controllerName;

        if (!class_exists($controllerClass, true)) {
            self::ErrorPage404();
        }

        $action = str_replace(['-', '_'], ' ', $actionName);

        $controller = new $controllerClass;
        $action = ucwords($action);

        if (method_exists($controller, $action)) {
            $controller->$action();
        }

        self::ErrorPage404();
    }

    public static function ErrorPage404(): void
    {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
    }
}