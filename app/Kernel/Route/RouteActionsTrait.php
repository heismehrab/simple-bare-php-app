<?php

namespace App\Kernel\Route;

use App\Kernel\Middleware\MiddlewareInterface;

/**
 * Brings options like middleware and etc...
 * for routes.
 */
trait RouteActionsTrait
{
    /**
     * @param \App\Kernel\Middleware\MiddlewareInterface $middleware
     *
     * @return void
     */
    public function middlewareAction(
        MiddlewareInterface $middleware
    ): void {
        self::setRouteMiddleware($middleware);
    }
}