<?php

namespace App\Kernel\Database;

use Exception;
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
    public static function query(string $query, array $bindings = []): bool|mysqli_result
    {
        self::getConnection()->begin_transaction();

        try {
            $query = self::getConnection()->prepare($query);

            $query->bind_param(
                str_repeat('s', count($bindings)),
                ... $bindings
            );

            $result = $query->execute();

            self::getConnection()->commit();

            return $result;
        } catch (Exception) {
            self::getConnection()->rollback();
        }

        return false;
    }

    /**
     * Closes the created connection to database
     * on destroy action.
     */
    public function __destruct()
    {
        self::$connection->close();

        self::$connection = null;
    }
}