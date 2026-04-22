<?php

namespace Toybox\Core\Components;

use Carbon\Carbon;

class AdminBar
{
    /**
     * Disables the WordPress admin bar from being rendered.
     *
     * @return void
     */
    public static function disable(): void
    {
        add_action('after_setup_theme', function () {
            add_filter('show_admin_bar', '__return_false');
        });
    }

    /**
     * Sets the logo in the admin bar.
     *
     * @return void
     */
    public static function setLogo()
    {
        add_action('admin_head', [static::class, 'setLogoInAdminBar']);
        add_action('wp_head',    [static::class, 'setLogoInAdminBar']);
    }

    public static function setLogoInAdminBar(): void
    {
        if (! is_admin_bar_showing()) {
            return;
        }

        $stylesheetDir = get_bloginfo('stylesheet_directory');
        $iconPath      = "{$stylesheetDir}/images/admin-logo.svg";

        ?>
        <style>
            #wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon {
                width: 20px;
                height: 20px;
            }

            #wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {
                content: "";
                display: block;
                width: 20px;
                height: 20px;
                background: url('<?= esc_url($iconPath) ?>') center center / contain no-repeat;
                color: transparent;
            }
        </style>
        <?php
    }

    /**
     * Replace the "Howdy" message in the WP admin area with a time-specific message.
     *
     * @return void
     */
    public static function replaceHowdy(): void
    {
        add_filter("admin_bar_menu", function ($adminBar) {
            $now   = Carbon::now();

            switch (true) {
                case $now->hour >= 6 && $now->hour < 12:
                    $howdy = "Good morning,";
                    break;

                case $now->hour >= 12 && $now->hour < 17:
                    $howdy = "Good afternoon,";
                    break;

                case $now->hour >= 17:
                    $howdy = "Good evening,";
                    break;

                default:
                    $howdy = "Welcome,";
                    break;
            }

            $myAccount = $adminBar->get_node('my-account');

            $adminBar->add_node([
                'id'    => 'my-account',
                'title' => str_replace('Howdy,', $howdy, $myAccount->title),
            ]);
        });
    }
}
