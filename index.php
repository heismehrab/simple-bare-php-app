<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Kernel\Kernel;

// Serves the Application.
echo Kernel::handle();

// Terminates the Application.
Kernel::terminate();
