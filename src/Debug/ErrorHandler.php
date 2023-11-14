<?php

namespace Toybox\Core\Debug;

use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

class ErrorHandler
{
    /**
     * Sets up error reporting for the application. Note that the pretty page handler will only display when WP_DEBUG is
     * set to true.
     *
     * @param int|null $errorLevel
     *
     * @return void
     */
    public static function boot(?int $errorLevel): void
    {
        // Sets the error reporting level - while we're in debug mode
        // we should really show all errors, even if they're just
        // warnings or notices.
        error_reporting($errorLevel);

        add_action("after_setup_theme", function () {
            // Register the error handler, but only if we're in a debug environment.
            // Otherwise, there could be information disclosure.
            if (defined("WP_DEBUG") && WP_DEBUG === true) {
                $whoops = new Run();
                $whoops->pushHandler(new PrettyPageHandler());
                $whoops->register();
            }
        }, 1);
    }
}