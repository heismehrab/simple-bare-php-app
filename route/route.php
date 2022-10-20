<?php

namespace App\Kernel\Route;

use App\Http\Middleware\AuthMiddleware;

use App\Http\Controller\{
    AuthController,
    LinkShortenerController
};

Route::post('users', [AuthController::class, 'register']);

Route::post('link-shortener', [LinkShortenerController::class, 'create'])
    ->middlewareAction(new AuthMiddleware);

Route::delete('link-shortener', [LinkShortenerController::class, 'delete'])
    ->middlewareAction(new AuthMiddleware);

Route::patch('link-shortener', [LinkShortenerController::class, 'update'])
    ->middlewareAction(new AuthMiddleware);

Route::get('link-shortener', [LinkShortenerController::class, 'index'])
    ->middlewareAction(new AuthMiddleware);

// Register above defined routes.
return Route::run();