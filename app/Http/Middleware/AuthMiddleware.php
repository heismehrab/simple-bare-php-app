<?php

namespace App\Http\Middleware;

use App\Repositories\UserRepository;

use App\Kernel\Middleware\MiddlewareInterface;

use Firebase\JWT\{
    Key,
    JWT
};

/**
 * Authorize requests with their tokens.
 */
class AuthMiddleware implements MiddlewareInterface
{
    /**
     * {@inheritDoc}
     *
     * @return bool
     */
    public function handle(): bool
    {
        if (! isset($_SERVER['HTTP_X_TOKEN'])) {
            return false;
        }

        $userCredentials = JWT::decode(
            $_SERVER['HTTP_X_TOKEN'],
            new Key($_ENV['JWT_KEY'], 'HS256')
        );

        return (new UserRepository)
            ->checkUser($userCredentials->userId);
    }
}