<?php

namespace App\Http\Controller;

use Firebase\JWT\JWT;

use App\Repositories\UserRepository;

use App\Kernel\Controller\BaseController;
use App\Kernel\Request\HttpRequest\Request;

/**
 * A legacy class to register/login users.
 */
class AuthController extends BaseController
{
    /**
     * Registers a new user.
     *
     * @return string
     *
     * @throws \App\Kernel\Route\Exceptions\RouteNotFoundException
     */
    public function register(): string
    {
        $userId = (new UserRepository)->createUser(
            Request::getParam('email')
        );

        $payload = ['userId' => $userId];
        $token = JWT::encode($payload, $_ENV['JWT_KEY'], 'HS256');

        return $this->response(
            statusCode: 201,
            data: [
                'token' => $token
            ],
            developerMessages: 'user created.'
        );
    }

    public function login()
    {
        
    }
}