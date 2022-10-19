<?php

namespace App\Repositories;

use App\Kernel\Database\Mysql;

/**
 * A small repository to communicate with database and store
 * shortened links.
 */
class UrlShortenerRepository implements GeneralRepositoryInterface
{
    /**
     * @param string $query
     * @param array $bindings
     *
     * @return mixed
     */
    public function rawQuery(string $query, array $bindings = []): mixed
    {
        return Mysql::query($query, $bindings);
    }
}