<?php

namespace App\Kernel;

/**
 * Designed to style the Kernel's handlers,
 * recommended for all Kernel bindings
 * such as Router, Database and etc..
 */
interface KernelHandlerInterface
{
    /**
     * Main function for all binding classes.
     *
     * @return void
     */
    public static function handle(): void;
}