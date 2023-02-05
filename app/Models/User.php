<?php

namespace app\Models;

class User
{
    public int $id;

    public function __construct(
        public string $username,
        public string $password,
        public string $token
    )
    {
    }
}