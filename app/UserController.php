<?php

namespace app;

use app\Models\User;

class UserController
{
    public function user($params)
    {
        $id = $params['id'];
        $user = User::find($id);

        if (!$user) {
            Response::setHttpStatus(404);
            return json_encode(['errors' => "Couldn't find user with id ${$id}"]);
        }

        Response::setHttpStatus(200);
        return json_encode(['user' => $user]);
    }

    public function create(): string
    {
        $request = json_decode(file_get_contents("php://input"), true);

        $username = $request['username'];
        $password = $request['password'];
        $passwordConfirm = $request['password_confirm'];

        if ($password !== $passwordConfirm) {
            return json_encode(['errors' => 'Password field doesnt match password confirm field']);
        }

        $token = User::generateToken();
        $user = new User($username, $password, $token);

        if (!User::validate($user->username, $user->password)) {
            Response::setHttpStatus(400);
            return json_encode(['errors' => $errors]);
        }

        if (!$user->create()) {
            Response::setHttpStatus(500);
            return json_encode(['errors' => 'Couldn\'t save user']);
        }

        Response::setHttpStatus(201);
        return json_encode(['user' => [
            'id' => $user->id,
            'username' => $user->username,
            'token' => $user->token
        ]]);
    }

    public function update($params)
    {
        $id = $params['id'];
        $request = json_decode(file_get_contents("php://input"), true);

        $user = User::find($id);

        if (!$user) {
            Response::setHttpStatus(404);
            return json_encode(['errors' => "Couldn't find user with id ${$id}"]);
        }

        if (!User::validate(
            $request['username'],
            $request['password'])
        ) {
            Response::setHttpStatus(400);
            return json_encode(['errors' => $user->errors]);
        }

        if (!User::update(
            $id,
            $request['username'],
            $request['password'])
        ) {
            Response::setHttpStatus(400);
            return json_encode(['errors' => "Couldn't update user with id ${$id}"]);
        }

        Response::setHttpStatus(200);
        return json_encode(['user' => $user]);
    }

    public function delete($params)
    {
        $id = $params['id'];
        $user = User::find($id);

        if (!$user) {
            Response::setHttpStatus(404);
            return json_encode(['errors' => "Couldn't find user with id ${$id}"]);
        }

        if (!User::delete($id)) {
            Response::setHttpStatus(400);
            return json_encode(['errors' => "Couldn't delete user with id ${$id}"]);
        }

        Response::setHttpStatus(204);
        return json_encode('');
    }

    public function auth()
    {

    }
}