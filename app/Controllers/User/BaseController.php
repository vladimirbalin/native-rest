<?php

namespace app\Controllers\User;

use app\Repositories\UserRepository;
use app\Services\UserService;
use core\Controller;

class BaseController extends Controller
{
    protected UserService $service;
    protected UserRepository $repository;

    public function __construct()
    {
        $this->service = new UserService();
        $this->repository = new UserRepository();

        header('Content-Type: application/json');
    }
}