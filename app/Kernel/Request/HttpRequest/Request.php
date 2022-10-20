<?php

namespace App\Kernel\Request\HttpRequest;

use App\Kernel\Route\Route;

use App\Kernel\Route\Exceptions\RouteNotFoundException;

/**
 * Keeps details of current request
 * using Kernel's Router system.
 */
abstract class Request
{
    /**
     * @return string
     *
     * @throws RouteNotFoundException
     */
    public static function getUri(): string
    {
        return Route::getCurrentRouteDetails()['route'];
    }

    /**
     * @return string
     *
     * @throws RouteNotFoundException
     */
    public static function getMethod(): string
    {
        return Route::getCurrentRouteDetails()['httpMethod'];
    }

    /**
     * @return string
     *
     * @throws RouteNotFoundException
     */
    public static function getTargetClass(): string
    {
        return Route::getCurrentRouteDetails()['class'];
    }

    /**
     * @return string
     *
     * @throws RouteNotFoundException
     */
    public static function getTargetMethod(): string
    {
        return Route::getCurrentRouteDetails()['classMethod'];
    }

    /**
     * @return array
     *
     * @throws RouteNotFoundException
     */
    public static function getParams(): array
    {
        return Route::getCurrentRouteDetails()['params'];
    }

    /**
     * @param string $param
     * @param $default
     *
     * @return mixed
     *
     * @throws RouteNotFoundException
     */
    public static function getParam(string $param, $default = null): mixed
    {
        return Route::getCurrentRouteDetails()['params'][$param] ?: $default;
    }

    /**
     * @return ?string
     *
     * @throws RouteNotFoundException
     */
    public static function getMiddleware(): ?string
    {
        return Route::getCurrentRouteDetails()['routeMiddleware'];
    }
}