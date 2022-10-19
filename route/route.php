<?php

namespace App\Kernel\Route;

use App\Http\Controller\ExampleController;

Route::get('example', [ExampleController::class, 'test']);

// Register above defined routes.
return Route::run();