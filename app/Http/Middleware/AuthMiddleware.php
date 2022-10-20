<?php

namespace App\Http\Middleware;

use App\Kernel\Middleware\MiddlewareInterface;

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
        return $_SERVER['HTTP_X_TOKEN'] === $_ENV['APP_X_HEADER_TOKEN'];
    }
}