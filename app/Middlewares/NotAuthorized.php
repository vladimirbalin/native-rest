<?php

namespace app\Middlewares;

use app\Helpers\HttpHelper;
use app\Repositories\UserRepository;
use app\Response;

class NotAuthorized
{
    public function execute()
    {
        $tokenHeader = HttpHelper::getAuthorizationHeader();

        if (
            is_null($tokenHeader) ||
            ! $this->userExists($tokenHeader)
        ) {
            Response::setHttpStatus(401);
            echo json_encode(['errors' => "Unauthorized"]);
            exit();
        }
    }

    private function userExists($tokenHeader){
        return (new UserRepository)->findByToken(
            explode(" ", $tokenHeader)[1]
        );
    }
}