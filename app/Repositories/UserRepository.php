<?php

namespace app\Repositories;

use core\Application;

class UserRepository
{
    public function findById(int $id): array|false
    {
        $sql = "SELECT username 
                FROM users
                WHERE id=:id";
        $statement = Application::$app->db->prepare($sql);
        $statement->bindValue(":id", $id);
        $statement->execute();

        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    public function findByToken(string $token): array|false
    {
        $sql = "SELECT username, token 
                FROM users
                WHERE token=:token";
        $statement = Application::$app->db->prepare($sql);
        $statement->bindValue(":token", $token);
        $statement->execute();

        return $statement->fetch(\PDO::FETCH_ASSOC);
    }
}