<?php

namespace App\Http\Controller;

use App\Kernel\Controller\BaseController;
use App\Kernel\Request\HttpRequest\Request;

use App\Repositories\UrlShortenerRepository;
use App\Services\UrlShortener\UrlShortenerService;

/**
 * A controller which provided for url
 * shortener service endpoints.
 */
class LinkShortenerController extends BaseController
{
    /**
     * @return string
     *
     * @throws \App\Kernel\Route\Exceptions\RouteNotFoundException
     * @throws \App\Services\UrlShortener\Exceptions\InvalidUrlValidationException
     */
    public function create(): string
    {
        $result = (new UrlShortenerService)
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
}