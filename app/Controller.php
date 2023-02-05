<?php

namespace app;

class Controller
{
    public array $middlewares = [];

    public function getMiddlewares()
    {
        return $this->middlewares;
    }

    public function registerMiddleware(object $middleware)
    {
        $this->middlewares[] = $middleware;
    }
}