<?php

namespace Toybox\Core\Components;

use Carbon\Carbon;

class Transient
{
    /**
     * Sets a transient - this allows data to be cached easily within WordPress.
     *
     * @param string     $name       The name of the transient.
     * @param mixed      $contents   The data to store.
     * @param int|Carbon $expiration The expiration time. If an integer is passed, it's the time in seconds. If a Carbon timestamp is passed, expiry will happen at that time.
     *
     * @return bool
     */
    public static function set(string $name, mixed $contents, int|Carbon $expiration): bool
    {
        if (! is_int($expiration)) {
            // Fetch expiry date from timestamp
            $expiration = now()->diffInSeconds($expiration);
        }

        return set_transient($name, $contents, $expiration);
    }

    /**
     * Gets a transient from the cache.
     *
     * @param string $name The name of the transient.
     *
     * @return mixed
     */
    public static function get(string $name): mixed
    {
        return get_transient($name);
    }

    /**
     * Delete a transient.
     *
     * @param string $name The name of the transient.
     *
     * @return bool
     */
    public static function delete(string $name): bool
    {
        return delete_transient($name);
    }
}
