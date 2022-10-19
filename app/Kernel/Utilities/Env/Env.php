<?php

namespace App\Kernel\Utilities\Env;

use App\Kernel\Utilities\UtilitiesInterface;

use Dotenv\Dotenv;

/**
 * Loads DotEnv package to store sensitive data
 * in .env file.
 *
 * @see https://github.com/vlucas/phpdotenv
 */
class Env implements UtilitiesInterface
{
    private const ENV_FILE_ADDRESS = __DIR__ . '/../../../../';

    /**
     * Loads DotEnv package.
     *
     * @return void
     */
    public static function load(): void
    {
        $dotenv = Dotenv::createImmutable(self::ENV_FILE_ADDRESS);

        $dotenv->load();
    }
}