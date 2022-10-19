<?php

namespace App\Kernel;

use Throwable;

use App\Kernel\Route\Route;

use App\Kernel\Utilities\UtilitiesInterface;

use App\Kernel\Utilities\Env\Env;
use App\Kernel\Utilities\Env\Exceptions\UtilitiesLoadingException;

/**
 * Serves Application's requirements at first hit.
 */
class Kernel implements KernelHandlerInterface
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
     * {@inheritDoc}
     *
     * @return void
     *
     * @throws UtilitiesLoadingException
     */
    public static function handle(): void
    {
        // Load required Utilities.
        self::loadBaseBindings();

        // Register Application bindings.
        Route::handle();
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