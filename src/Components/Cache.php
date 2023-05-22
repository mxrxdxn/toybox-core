<?php

namespace Toybox\Core\Components;

use Carbon\Carbon;

class Cache
{
    /**
     * Enables adding a Cache-Control header on page responses. This allows the user's browser to cache the response
     * and save a visit to the server. It's probably best to keep the expiration low (10 mins or so) in case the page is
     * altered in the backend.
     *
     * @param bool       $visitorsOnly Whether to only cache for visitors, or for all users.
     * @param int|Carbon $expiration   The expiration time, in seconds, or a Carbon timestamp of when to expire.
     *
     * @return void
     */
    public static function enable(bool $visitorsOnly = true, int|Carbon $expiration = 600): void
    {
        add_action('template_redirect', function () use ($expiration, $visitorsOnly) {
            if (($visitorsOnly === true && ! is_user_logged_in()) || $visitorsOnly === false) {
                if (! is_int($expiration)) {
                    // Fetch expiry date from timestamp
                    $expiration = now()->diffInSeconds($expiration);
                }

                // Enable caching
                header('Cache-Control: public, max-age=' . $expiration);
            }
        });
    }
}