<?php

namespace Toybox\Core\Components;

class Frontend
{
    /**
     * Disables the frontend of a website with a message and an optional redirect.
     *
     * @param string       $message         The message to display to the user.
     * @param int          $maintenanceCode The code to use for maintenance page, defaults to 503.
     * @param string|false $redirect        The URL to redirect to, or blank.
     * @param int          $redirectCode    Use either 301 (permanent) or 302 (temporary) redirect code.
     *
     * @return void
     */
    public static function disable(string $message, int $maintenanceCode = 503, string|false $redirect = false, int $redirectCode = 302): void
    {
        add_action("init", function () use ($message, $maintenanceCode, $redirect, $redirectCode) {
            if ($redirect === false) {
                status_header($maintenanceCode);
                die($message);
            }

            wp_redirect($redirect, $redirectCode);
        });
    }
}
