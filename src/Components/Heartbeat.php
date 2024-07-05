<?php

namespace Toybox\Core\Components;

class Heartbeat
{
    /**
     * Disable the Heartbeat API.
     *
     * @return void
     */
    public static function disable(): void
    {
        add_action('init', function () {
            wp_deregister_script('heartbeat');
        }, 1);
    }
}
