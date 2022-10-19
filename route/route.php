<?php

namespace App\Kernel\Route;

use App\Http\Controller\LinkShortenerController;

Route::post('link-shortener', [LinkShortenerController::class, 'create']);
Route::delete('link-shortener', [LinkShortenerController::class, 'delete']);
Route::patch('link-shortener', [LinkShortenerController::class, 'update']);

// Register above defined routes.
return Route::run();