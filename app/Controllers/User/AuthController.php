<?php

namespace app\Controllers\User;

use app\Response;

class AuthController extends BaseController
{
    public function __invoke()
    {
        $request = json_decode(file_get_contents("php://input"), true);

        if (!$this->service->validate($request)) {
            Response::setHttpStatus(400);
            return json_encode(['errors' => 'Validation errors']);
        }

        $user = $this->repository->findByToken($request['token']);
        if (!$user) {
            Response::setHttpStatus(401);
            return json_encode(['errors' => "Couldn't authenticate"]);
        }

        Response::setHttpStatus(200);
        return json_encode(['user' => $user]);
    }
}