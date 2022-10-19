<?php

namespace App\Kernel;

use Throwable;

use App\Kernel\Route\Route;
use App\Kernel\Database\Mysql;

use App\Kernel\Utilities\UtilitiesInterface;

use App\Kernel\Utilities\Env\Env;
use App\Kernel\Utilities\Env\Exceptions\UtilitiesLoadingException;

use App\Kernel\Route\Exceptions\RouteNotFoundException;

use App\Kernel\Request\HttpRequest\Request;
use App\Kernel\Request\ControllerAction\RequestActionPipeline;

/**
 * Serves Application's requirements at first hit.
 */
class Kernel
{
    /**
     * Bootstraps base utilities which are required
     * for serving the Application.
     *
     * @var UtilitiesInterface[]
     */
    private static array $baseUtilities = [
        Env::class
    ];

    /**
     * Register required bindings and utilities.
     *
     * @return mixed
     *
     * @throws UtilitiesLoadingException|RouteNotFoundException
     */
    public static function handle(): mixed
    {
        // Load required Utilities.
        self::loadBaseBindings();

        // Register Application bindings.
        Route::handle();

        Mysql::handle();

        return (new RequestActionPipeline)
            ->class(Request::getTargetClass())
            ->method(Request::getTargetMethod())
            ->execute();
    }

    /**
     * Load base bindings/utilities.
     *
     * @return void
     *
     * @throws UtilitiesLoadingException
     */
    private static function loadBaseBindings(): void
    {
        try {
            /** @var UtilitiesInterface $utility */

            foreach (self::$baseUtilities as $utility) {
                $utility::load();
            }
        } catch (Throwable $exception) {
            throw new UtilitiesLoadingException(
                $exception->getMessage(),
                $exception->getCode(),
                $exception
            );
        }
    }
}