<?php

namespace app\Services;

use app\Application;
use Exception;

class UserService
{
    const ATTRIBUTES = ['username', 'password', 'token'];

    /**
     * @throws Exception
     */
    public function generateToken($length): string
    {
        if (!function_exists('random_bytes')) {
            throw new Exception('Unable to generate a random key');
        }
        $input = random_bytes($length);
        $token = strtr(base64_encode($input), '+/', '-_');

        return $token;
    }

    public function validate(array $request): bool
    {
        //TODO
        return true;
    }

    public function create(array $request): bool
    {
        $sql = "INSERT INTO users 
                       (username, password, token)
                VALUES (:username, :password, :token)";
        $statement = Application::$app->db->prepare($sql);

        foreach (self::ATTRIBUTES as $attribute) {
            $statement->bindValue(
                ":$attribute",
                $request[$attribute]
            );
        }
        return $statement->execute();
    }


    public function update(array $request): bool
    {
        $sql = "UPDATE users SET 
                username=:username, 
                password=:password 
                WHERE id=:id";

        $statement = Application::$app->db->prepare($sql);

        foreach (self::ATTRIBUTES as $attribute) {
            $statement->bindValue(
                ":$attribute",
                $request[$attribute]
            );
        }
        return $statement->execute();
    }


    public function delete(int $id): bool
    {
        $sql = "DELETE FROM users
                WHERE id=:id";
        $statement = Application::$app->db->prepare($sql);

        $statement->bindValue(":id", $id);
        return $statement->execute();
    }
}