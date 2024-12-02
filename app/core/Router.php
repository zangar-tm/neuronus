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
            $this->middleware[$method][$uri] = $middleware;
        }
    }

    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = explode('?', $_SERVER['REQUEST_URI'])[0];

        foreach ($this->routes[$method] as $route => [$controller, $methodFunc]) {
            $pattern = preg_replace('/\{[^\/]+\}/', '([^\/]+)', $route);
            $pattern = '#^' . $pattern . '$#';

            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches);

                if (isset($this->middleware[$method][$route])) {
                    $this->checkMiddleware($this->middleware[$method][$route]);
                }

                if (!class_exists($controller)) {
                    throw new \Exception("Контроллер $controller не найден.");
                }

                if (!method_exists($controller, $methodFunc)) {
                    throw new \Exception("Метод $methodFunc в контроллере $controller не найден.");
                }

                $controllerInstance = new $controller();
                call_user_func_array([$controllerInstance, $methodFunc], $matches);
                return;
            }
        }


        http_response_code(404);
        echo "404 Not Found";
    }

    private function checkMiddleware($method)
    {
        return Middleware::$method();
    }
}
