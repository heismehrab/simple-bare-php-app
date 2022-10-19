<?php

namespace App\Repositories;

/**
 * Created for describing a general schema for repositories.
 */
interface GeneralRepositoryInterface
{
    /**
     * Runs a raw query.
     *
     * @param string $query
     * @param array $bindings
     *
     * @return mixed
     */
    public function rawQuery(string $query, array $bindings = []): mixed;
}