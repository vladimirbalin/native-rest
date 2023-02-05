<?php

namespace app\Controllers\User;

use app\Middlewares\NotAuthorized;
use core\Response;

class UpdateController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->registerMiddleware(new NotAuthorized);
    }

    public function __invoke($params)
    {
        $id = (int)$params['id'];
        $request = json_decode(file_get_contents("php://input"), true);

        $user = $this->repository->findById($id);
        if (!$user) {
            Response::setHttpStatus(404);
            return json_encode(['errors' => "Couldn't find user with id $id"]);
        }

        if (!$this->service->validate($request)) {
            Response::setHttpStatus(400);
            return json_encode(['errors' => ['$user->errors']]);
        }

        if (!$this->service->update($request)) {
            Response::setHttpStatus(400);
            return json_encode(['errors' => "Couldn't update user with id ${$id}"]);
        }

        Response::setHttpStatus(200);
        return json_encode(['user' => $user]);
    }
}