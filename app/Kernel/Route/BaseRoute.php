<?php

namespace App\Kernel\Route;

use App\Kernel\Route\Exceptions\{
    ClassNotFoundException,
    MethodNotFoundException,
    RouteNotFoundException
};

/**
 * Register and handle Application defined routes.
 */
abstract class BaseRoute
{
    /**
     * Keeps the address of Application's defined routes.
     *
     * @var string
     */
    private const ROUTES_FILE_ADDRESS = __DIR__ . '/../../../route/route.php';

    /**
     * Keeps all route addresses.
     *
     * @var array
     */
    private static array $routes = [];

    /**
     * Keeps current route details.
     *
     * @var array
     */
    private static array $currentRouteDetails = [];

    /**
     * Retrieve defined routes in route.php
     *
     * @return array|array[]
     */
    public static function getDefinedRoutes(): array
    {
        return self::$routes;
    }

    /**
     * Returns current route details.
     *
     * @return array
     *
     * @throws \App\Kernel\Route\Exceptions\RouteNotFoundException
     */
    public static function getCurrentRouteDetails(): array
    {
        if (count(self::$currentRouteDetails)) {
            return self::$currentRouteDetails;
        }

        $method = $_SERVER['REQUEST_METHOD'];

        $uri = explode('?', $_SERVER['REQUEST_URI'])[0];

        $actionController = self::getDefinedRoutes()[$method][$uri];

        if ($actionController == null) {
            throw new RouteNotFoundException("Route {$uri} not found.");
        }

        return self::$currentRouteDetails = [
            'route' => $uri,
            'httpMethod' => $method,

            'class' => $actionController[0],
            'classMethod' => $actionController[1],

            'params' => $_GET ?: $_POST
        ];
    }

    /**
     * Register defined routes.
     *
     * @return void
     */
    protected static function registerRoutes(): void
    {
        self::$routes = require_once self::ROUTES_FILE_ADDRESS;
    }

    /**
     * Validate routes, then register them.
     *
     * @param string $method
     * @param string $url
     * @param array $class
     *
     * @return void
     *
     * @throws ClassNotFoundException
     * @throws MethodNotFoundException
     */
    protected static function registerRoute(
        string $method,
        string $url,
        array $class
    ): void {
        // Validate route's class.
        if (! class_exists($class[0])) {
            throw new ClassNotFoundException("Target class {$class[0]} not found.");
        }

        if (! method_exists($class[0], $class[1])) {
            throw new MethodNotFoundException("Method {$class[0]}:{$class[1]}() not found.");
        }

        // TODO. Implement some validations for routes.

        // Add or update new route.
        if (! str_starts_with($url,'/')) {
            $url = '/' . $url;
        }

        self::$routes[$method][$url] = $class;
    }
}