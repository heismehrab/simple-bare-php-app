<?php

namespace App\Kernel\Utilities;

/**
 * An interface to style the utilities (Third-party packages and ...)
 */
interface UtilitiesInterface
{
    /**
     * Main function to load utilities.
     *
     * @return void
     */
    public static function load(): void;
}