<?php

namespace App\Http\Controller;

use App\Kernel\Controller\BaseController;
use App\Kernel\Request\HttpRequest\Request;

use App\Repositories\UrlShortenerRepository;
use App\Services\UrlShortener\UrlShortenerServiceOperations;

/**
 * A controller which provided for url
 * shortener service endpoints.
 */
class LinkShortenerController extends BaseController
{
    /**
     * @return string
     */
    public function index(): string
    {
        return $this->response();
    }

    /**
     * @return string
     *
     * @throws \App\Kernel\Route\Exceptions\RouteNotFoundException
     * @throws \App\Services\UrlShortener\Exceptions\InvalidUrlValidationException
     */
    public function create(): string
    {
        $result = (new UrlShortenerServiceOperations)
            ->encodeAndSave(
                Request::getParam('link'),
                new UrlShortenerRepository
            );

        return $this->response(
            statusCode: 201,
            data: $result,
            developerMessages: 'Resource created'
        );
    }

    /**
     * @return string
     *
     * @throws \App\Kernel\Route\Exceptions\RouteNotFoundException
     */
    public function delete(): string
    {
        $result = (new UrlShortenerServiceOperations)
            ->delete(
                Request::getParam('link'),
                new UrlShortenerRepository
            );

        return $this->response(
            statusCode: 204,
            data: $result,
            developerMessages: 'Resource deleted'
        );
    }

    /**
     * @return string
     *
     * @throws \App\Kernel\Route\Exceptions\RouteNotFoundException
     */
    public function update(): string
    {
        $result = (new UrlShortenerServiceOperations)
            ->update(
                Request::getParam('link'),
                Request::getParam('replacedLink'),
                new UrlShortenerRepository
            );

        return $this->response(
            data: $result,
            developerMessages: 'Resource updated'
        );
    }
}