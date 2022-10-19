<?php

namespace App\Kernel\Route;

use App\Kernel\Route\Exceptions\{
    ClassNotFoundException,
    MethodNotFoundException
};

/**
 * Handles Application defined routes and finds
 * required Controller of current url.
 */
class Route extends BaseRoute
{
    /**
     * Process and Handle Application routes,
     * then return the class of given URL.
     *
     * @return void
     *
     */
    public static function handle(): void
    {
        self::registerRoutes();
    }

    /**
     * Register GET routes.
     *
     * @param string $url
     * @param array $class
     *
     * @return void
     *
     * @throws ClassNotFoundException
     * @throws MethodNotFoundException
     */
    public static function get(string $url, array $class): void
    {
        self::registerRoute('GET', $url, $class);
    }

    /**
     * Register POST routes.
     *
     * @param string $url
     * @param array $class
     *
     * @return void
     *
     * @throws ClassNotFoundException
     * @throws MethodNotFoundException
     */
    public static function post(string $url, array $class): void
    {
        self::registerRoute('POST', $url, $class);
    }

    /**
     * Process and return defined routes.
     *
     * @return array[]
     */
    public static function run(): array
    {
        if (! count(self::getDefinedRoutes())) {
            self::handle();
        }

        return self::getDefinedRoutes();
    }
}