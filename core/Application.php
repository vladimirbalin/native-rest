<?php

namespace core;

class Application
{
    public Request $request;
    public Response $response;
    public Router $router;
    public Db $db;
    public static Application $app;

    public function __construct(
        public array $config
    )
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request);
        $this->db = new Db($this->config['db']);
        self::$app = $this;
    }

    public function run(): void
    {
        echo $this->router->resolve();
    }
}