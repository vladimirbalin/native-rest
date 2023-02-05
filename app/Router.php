<?php

namespace app;

class Router
{
    public array $routes = [];

    public function __construct(
        private Request  $request,
    )
    {
    }

    public function get(string $url, array|string $callback): void
    {
        $this->routes['GET'][$url] = $callback;
    }

    public function post(string $path, array|string $callback): void
    {
        $this->routes['POST'][$path] = $callback;
    }

    public function put(string $path, array|string $callback): void
    {
        $this->routes['PUT'][$path] = $callback;
    }

    public function delete(string $path, array|string $callback): void
    {
        $this->routes['DELETE'][$path] = $callback;
    }

    public function resolve(): string
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $parameters = $this->request->getParams();
        $callback = $this->routes[$method][$path];

        if (is_array($callback)) {
            $controller = new $callback[0];
            $callback[0] = $controller;
            $this->executeMiddlewares($callback[0]);
        }

        if (is_string($callback)) {
            $callback = new $callback;
            $this->executeMiddlewares($callback);
        }

        return call_user_func($callback, $parameters);
    }

    public function executeMiddlewares($callback): void
    {
        /** @var Controller $callback */
        foreach ($callback->getMiddlewares() as $middleware){
            call_user_func([$middleware, 'execute']);
        }
    }
}