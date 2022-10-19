<?php

namespace App\Kernel\Route;

use App\Http\Controller\LinkShortenerController;

Route::post('link-shortener', [LinkShortenerController::class, 'create']);

// Register above defined routes.
return Route::run();