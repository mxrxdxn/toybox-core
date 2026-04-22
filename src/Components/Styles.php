<?php

namespace Toybox\Core\Components;

use Exception;

class Styles
{
    /**
     * Enqueues any styles or scripts required by the theme.
     *
     * @param bool $disableCritical If set to true, the critical style will not be enqueued.
     *
     * @return void
     * @throws Exception
     */
    public static function boot(bool $disableCritical = false): void
    {
        add_action('wp_head', function () {
            Assets::printClient();
        }, 1);

        add_action('admin_head', function () {
            Assets::printClient();
        }, 1);

        if ($disableCritical !== true) {
            add_action("wp_enqueue_scripts", function () {
                Assets::enqueue('resources/scss/critical.scss');
            });
        }
    }
}
