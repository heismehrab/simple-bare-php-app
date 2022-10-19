<?php

namespace App\Services\UrlShortener;

use App\Repositories\GeneralRepositoryInterface;

use App\Services\UrlShortener\Exceptions\InvalidUrlValidationException;

/**
 * Handles operations like store, update
 * and delete in database.
 */
class UrlShortenerServiceOperations extends UrlShortenerService
{
    /**
     * Encodes a URL and saves it in database.
     *
     * @param string $url
     * @param GeneralRepositoryInterface $repository
     *
     * @return array
     *
     * @throws InvalidUrlValidationException
     */
    public function encodeAndSave(
        string $url,
        GeneralRepositoryInterface $repository
    ): array {

        $encodedUrl = $this->encodeUrl($url);

        $query = <<<HERE
            INSERT INTO links (link, encoded_link) VALUES (?, ?);
        HERE;

        // Store data in database.
        $repository->rawQuery($query, [$url, $encodedUrl]);

        return [
            'url' => $url,
            'encodedUrl' => $encodedUrl
        ];
    }

    /**
     * Deletes a URL and also delete
     * it from database.
     *
     * @param string $url
     * @param GeneralRepositoryInterface $repository
     *
     * @return array
     */
    public function delete(
        string $url,
        GeneralRepositoryInterface $repository
    ): array {

        $query = <<<HERE
            DELETE FROM links WHERE encoded_link = ? OR link = ?;
        HERE;

        // Store data in database.
        $repository->rawQuery($query, [$url, $url]);

        return [];
    }

    /**
     * Deletes an URL and also delete
     * it from database.
     *
     * @param string $url
     * @param string $replacedUrl
     * @param GeneralRepositoryInterface $repository
     *
     * @return array
     */
    public function update(
        string $url,
        string $replacedUrl,
        GeneralRepositoryInterface $repository
    ): array {

        $query = <<<HERE
            UPDATE links SET encoded_link = ? WHERE link = ? ;
        HERE;

        // Store data in database.
        $repository->rawQuery($query, [$replacedUrl, $url]);

        return [];
    }
}