<?php

namespace App\Kernel\Route;

use App\Kernel\KernelHandlerInterface;

use App\Kernel\Route\Exceptions\{
    ClassNotFoundException,
    MethodNotFoundException
};

/**
 * Handles Application defined routes and finds
 * required Controller of current url.
 */
class Route extends BaseRoute implements KernelHandlerInterface
{
    use RouteActionsTrait;

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
     * @return self
     *
     * @throws ClassNotFoundException
     * @throws MethodNotFoundException
     */
    public static function get(string $url, array $class): self
    {
        self::registerRoute('GET', $url, $class);

        return new Route;
    }

    /**
     * Register POST routes.
     *
     * @param string $url
     * @param array $class
     *
     * @return self
     *
     * @throws ClassNotFoundException
     * @throws MethodNotFoundException
     */
    public static function post(string $url, array $class): self
    {
        self::registerRoute('POST', $url, $class);

        return new Route;
    }

    /**
     * Register DELETE routes.
     *
     * @param string $url
     * @param array $class
     *
     * @return self
     *
     * @throws ClassNotFoundException
     * @throws MethodNotFoundException
     */
    public static function delete(string $url, array $class): self
    {
        self::registerRoute('DELETE', $url, $class);

        return new Route;
    }

    /**
     * Register PATCH routes.
     *
     * @param string $url
     * @param array $class
     *
     * @return self
     *
     * @throws ClassNotFoundException
     * @throws MethodNotFoundException
     */
    public static function patch(string $url, array $class): self
    {
        self::registerRoute('PATCH', $url, $class);

        return new Route;
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