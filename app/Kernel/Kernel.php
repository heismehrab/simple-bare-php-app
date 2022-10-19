<?php

namespace App\Kernel;

use App\Kernel\Route\Route;

/**
 * Serves Application's requirements at first hit.
 */
class Kernel implements KernelHandlerInterface
{
    /**
     * {@inheritDoc}
     *
     * @return void
     */
    public static function handle(): void
    {
        // Handle routes.
        Route::handle();
    }
}