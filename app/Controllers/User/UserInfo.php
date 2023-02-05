<?php

namespace app\Controllers\User;

use app\Middlewares\NotAuthorized;
use core\Response;

class UserInfo extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->registerMiddleware(new NotAuthorized);
    }

    public function __invoke($params)
    {
        $id = (int)$params['id'];

        $user = $this->repository->findById($id);
        if (!$user) {
            Response::setHttpStatus(404);
            return json_encode(['errors' => "Couldn't find user with this token"]);
        }

        Response::setHttpStatus(200);
        return json_encode(['user' => $user]);
    }
}