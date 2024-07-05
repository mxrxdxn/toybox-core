<?php

namespace Toybox\Core\Components;

class User
{
    /**
     * @var WP_User|null The user.
     */
    protected static WP_User|null $user = null;

    /**
     * Check if we're currently logged in as a user.
     *
     * @return bool
     */
    public static function loggedIn(): bool
    {
        return is_user_logged_in();
    }

    /**
     * Change the current user context to another user.
     *
     * @param WP_User $user
     *
     * @return static
     */
    public static function for(WP_User $user): static
    {
        static::$user = $user;

        return new static();
    }

    /**
     * Check if the user can perform a given capability.
     *
     * @param $capability
     *
     * @return bool
     */
    public static function can($capability): bool
    {
        if (static::$user !== null) {
            return user_can(static::$user, $capability);
        } else {
            return current_user_can($capability);
        }
    }
}
