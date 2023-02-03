<?php

namespace app;

class Router
{
    public array $routes = [];

    public function __construct(
        private Request  $request,
        private Response $response
    )
    {
    }

}