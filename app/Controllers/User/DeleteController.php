<?php

namespace app\Controllers\User;

use app\Middlewares\NotAuthorized;
use core\Response;

class DeleteController extends BaseController
{
    public array $middlewares = [];

    public function __construct()
    {
        $this->registerMiddleware(new NotAuthorized);
        parent::__construct();
    }

    public function __invoke($params)
    {
        $id = (int)$params['id'];

        if (! $this->service->validate([$id])) {
            Response::setHttpStatus(404);
            return json_encode(['errors' => "Validation errors"]);
        }

        if (! $this->service->delete($id)) {
            Response::setHttpStatus(400);
            return json_encode(['errors' => "Couldn't delete user with id $id"]);
        }

        Response::setHttpStatus(204);
        return json_encode('');
    }
}