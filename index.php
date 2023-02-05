<?php

use app\Application;
use app\Controllers\User\AuthController;
use app\Controllers\User\CreateController;
use app\Controllers\User\DeleteController;
use app\Controllers\User\UpdateController;
use app\Controllers\User\UserInfo;

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

$app = new Application($config);

$app->router->post('/user', CreateController::class);
$app->router->put('/user', UpdateController::class);
$app->router->delete('/user', DeleteController::class);
$app->router->post('/auth', AuthController::class);
$app->router->get('/user', UserInfo::class);

$app->run();