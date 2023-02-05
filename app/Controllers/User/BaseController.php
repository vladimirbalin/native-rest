<?php

namespace app\Controllers\User;

use app\Controller;
use app\Repositories\UserRepository;
use app\Services\UserService;

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