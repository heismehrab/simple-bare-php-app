<?php

namespace App\Kernel\Database;

use mysqli_result;

use App\Kernel\KernelHandlerInterface;

/**
 * Designed to communicate with Mysql database.
 */
class Mysql extends MysqlConnector implements KernelHandlerInterface
{
    /**
     * Main function for all binding classes.
     *
     * @return void
     */
    public static function handle(): void
    {
        self::getConnection();
    }

    /**
     * Execute a query and return its result.
     *
     * @param string $query
     * @param array $bindings
     *
     * @return bool|mysqli_result
     */
    public function query(string $query, array $bindings = []): bool|mysqli_result
    {
        return self::getConnection()->query($query);
    }
}