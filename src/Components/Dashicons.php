<?php

namespace Toybox\Core\Components;

class Dashicons
{
    /**
     * Disables the Dashicons stylesheet for users who are not logged in.
     *
     * @return void
     */
    public static function disable(): void
    {
        add_action('wp_enqueue_scripts', function () {
            if (!is_user_logged_in()) {
                wp_deregister_style('dashicons');
            }
        }, 100);
    }
}
