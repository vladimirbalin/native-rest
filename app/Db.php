<?php

namespace app;

use PDO;

class Db
{
    public PDO $connection;

    public function __construct(
        public array $config,
    )
    {
        $dsn = sprintf("%s:host=%s;dbname=%s;port=%d",
            $config['driver'],
            $config['host'],
            $config['dbname'],
            $config['port'] ?? 3306,
        );

        $this->connection = new PDO(
            $dsn,
            $config['username'] ?? '',
            $config['password'] ?? ''
        );
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}