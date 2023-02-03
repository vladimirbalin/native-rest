<?php

namespace app\Models;

use app\Application;

class User
{
    public int $id;
    public array $errors = [];

    public function __construct(
        public string $username,
        public string $password,
        public string $token
    )
    {
    }

    public function rules(): array
    {
        return [
            'username' => '',
            'password' => '',
        ];
    }

    public static function generateToken(): string
    {
        return 'random token';
    }

    public static function validate($username, $password): bool
    {
        //TODO
        return true;
    }

    public function create(): bool
    {
        $attributes = ['username', 'password', 'token'];
        $sql = "INSERT INTO users (username, password, token)
                VALUES (:username, :password, :token)";
        $statement = Application::$app->db->prepare($sql);
        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        return $statement->execute();
    }

    public static function find(int $id): array|false
    {
        $sql = "SELECT username, password, token 
                FROM users
                WHERE id=:id";
        $statement = Application::$app->db->prepare($sql);
        $statement->bindValue(":id", $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public static function update($id, $username, $password): bool
    {
        $sql = "UPDATE users SET 
                username=:username, 
                password=:password 
                WHERE id=:id";

        $statement = Application::$app->db->prepare($sql);

        $statement->bindValue(":username", $username);
        $statement->bindValue(":password", $password);
        $statement->bindValue(":id", $id);
        return $statement->execute();
    }


    public static function delete(int $id): bool
    {
        $sql = "DELETE FROM users
                WHERE id=:id";
        $statement = Application::$app->db->prepare($sql);

        $statement->bindValue(":id", $id);
        return $statement->execute();
    }
}