<?php

namespace App\Kernel;

use App\Kernel\Route\Route;

class Kernel
{
    public static function handle()
    {
        // Handle routes.
        Route::handle();
    }
}