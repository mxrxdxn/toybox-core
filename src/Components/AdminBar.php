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
        add_action('wp_before_admin_bar_render', function () {
            $stylesheetDir = get_bloginfo('stylesheet_directory');

            $output = <<<OUTPUT
                <style>
                    #wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {
                        background-image:    url({$stylesheetDir}/images/dashboard-logo.svg) !important;
                        background-position: 0 0;
                        background-repeat:   no-repeat;
                        color:               rgba(0, 0, 0, 0);
                        display:             block;
                    }
                    #wpadminbar #wp-admin-bar-wp-logo.hover > .ab-item .ab-icon {
                        background-position: 0 0;
                    }
                    #wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon {
                        width: 100px !important;
                    }
                </style>
            OUTPUT;

            echo $output;
        });
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
