<?php

namespace app;

class Application
{
    public Request $request;
    public Response $response;
    public Router $router;
    public Db $db;

    public function __construct(
        public array $config
    )
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router();
        $this->db = new Db($this->config['db']);
    }

    public function run()
    {
        
    }
}