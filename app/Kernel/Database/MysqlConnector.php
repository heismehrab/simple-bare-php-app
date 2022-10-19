<?php

namespace App\Kernel\Database;

use mysqli;

use Throwable;

use App\Kernel\Database\Exceptions\DatabaseConnectionException;

/**
 * Creates a connection to Mysql database.
 */
class MysqlConnector
{
    protected static mysqli|null $connection = null;

    /**
     * @throws DatabaseConnectionException
     */
    private function __construct()
    {
        try {
            self::$connection = new mysqli(
                $_ENV['DB_HOST'],
                $_ENV['DB_USERNAME'],
                $_ENV['DB_PASSWORD'],
                $_ENV['DB_NAME']
            );
        } catch (Throwable $exception) {
            throw new DatabaseConnectionException(
                $exception->getMessage(),
                $exception->getCode(),
                $exception
            );
        }
    }

    /**
     * Create a new instance of database;
     *
     * @return void
     */
    private static function createConnection(): void
    {
        new self;
    }

    /**
     * Gets an instance of database;
     *
     * @return mysqli
     */
    protected static function getConnection(): mysqli
    {
        if (self::$connection) {
            return self::$connection;
        }

        // Creates a new database connection.
        self::createConnection();

        return self::$connection;
    }
}