<?php

namespace app\core;

class Router
{
    private array $routes = [];
    private array $middleware = [];

    public function get(string $uri, array $action, $middleware = null): void
    {
        $this->registerRoute('GET', $uri, $action, $middleware);
    }

    public function post(string $uri, array $action, $middleware = null): void
    {
        $this->registerRoute('POST', $uri, $action, $middleware);
    }

    private function registerRoute(string $method, string $uri, array $action, $middleware): void
    {
        $this->routes[$method][$uri] = $action;

        if ($middleware) {
            $this->middleware[$method][$uri][] = $middleware;
        }
    }

    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = explode('?', $_SERVER['REQUEST_URI'])[0];

        if (isset($this->routes[$method][$uri])) {
            [$controller, $method] = $this->routes[$method][$uri];

            if (!class_exists($controller)) {
                throw new \Exception("Контроллер $controller не найден.");
            }

            if (!method_exists($controller, $method)) {
                throw new \Exception("Метод $method в контроллере $controller не найден.");
            }

            $controllerInstance = new $controller();
            $controllerInstance->$method();
        } else {
            http_response_code(404);
            echo "404 Not Found";
        }
    }

}
