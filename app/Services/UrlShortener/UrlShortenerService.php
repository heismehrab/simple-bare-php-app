<?php

namespace App\Services\UrlShortener;

use App\Services\UrlShortener\Exceptions\InvalidUrlValidationException;

/**
 * Encode and decode URLs to make them shorter
 * using base64_encode function and
 * related decoder.
 */
class UrlShortenerService
{
    /**
     * Encode a URL and make it short.
     *
     * @param string $url
     *
     * @return string
     *
     * @throws InvalidUrlValidationException
     */
    public function encodeUrl(string $url): string
    {
        if (! $this->validateUrl($url)) {
            throw new InvalidUrlValidationException("Invalid Url {$url}");
        }

        $domain = $this->getConstantLink();

        return $domain . base64_encode($url);
    }

    /**
     * Decode a shorted Url.
     *
     * @param string $url
     *
     * @return string
     */
    public function decodeUrl(string $url): string
    {
        $domain = $this->getConstantLink();

        return base64_decode(
            explode($domain, $url)[1]
        );
    }

    /**
     * Returns Application's specified
     * constant link for URLs.
     *
     * @return string
     */
    private function getConstantLink(): string
    {
        return $_ENV['URL_SHORTENER_SERVICE_DOMAIN'];
    }

    /**
     * Validate the given URL.
     *
     * @param string $url
     *
     * @return bool
     */
    private function validateUrl(string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL);

        /*
        return preg_match(
            '(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})',
            $url
        );
        */
    }
}