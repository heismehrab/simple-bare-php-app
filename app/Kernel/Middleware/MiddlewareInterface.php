<?php

namespace App\Kernel\Middleware;

/**
 * Designed to style Application middlewares.
 */
interface MiddlewareInterface
{
    /**
     * Runs before action controller.
     *
     * Return TRUE if pass the conditions.
     *
     * @return bool
     */
    public function handle(): bool;
}