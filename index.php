<?php

require_once __DIR__ . '/vendor/autoload.php';

$config = [
    'db' => [
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'port' => 3306,
        'dbname' => 'native-rest',
        'username' => 'root',
        'password' => 'root'
    ]
];

$app = new \app\Application($config);
