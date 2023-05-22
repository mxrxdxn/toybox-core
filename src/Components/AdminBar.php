<?php

namespace Toybox\Core\Components;

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
}