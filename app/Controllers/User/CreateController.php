<?php

namespace app\Controllers\User;

use core\Response;

class CreateController extends BaseController
{
    public function __invoke()
    {
        $request = json_decode(file_get_contents("php://input"), true);

        $validated = $this->service->validate($request);

        if (!$validated) {
            Response::setHttpStatus(400);
            return json_encode(['errors' => 'Validation errors']);
        }

        $token = $this->service->generateToken(128);

        if (!$this->service->create([...$request, 'token' => $token])) {
            Response::setHttpStatus(500);
            return json_encode(['errors' => 'Couldn\'t create user']);
        }

        Response::setHttpStatus(201);
        $user = $this->repository->findByToken($token);
        return json_encode(['user' => $user]);
    }
}