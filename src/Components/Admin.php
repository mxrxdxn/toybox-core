<?php

namespace Toybox\Core\Components;

use Toybox\Core\Theme;

class Admin
{
    /**
     * Hide the welcome panel from displaying.
     *
     * @return void
     */
    public static function hideWelcomePanel(): void
    {
        remove_action('welcome_panel', 'wp_welcome_panel');
    }

    /**
     * Stop non-admin users from seeing WordPress update notifications.
     *
     * @return void
     */
    public static function disableUpdateNag(): void
    {
        add_action('admin_menu', function () {
            if (! current_user_can('update_core')) {
                remove_action('admin_notices', 'update_nag', 3);
            }
        });
    }

    /**
     * Sets the footer text.
     *
     * @return void
     */
    public static function setFooterText()
    {
        add_filter('admin_footer_text', function () {
            $version = Theme::VERSION;
            echo "<span id='footer-thankyou'>Powered by <a href='https://maxwebsolutions.co.uk'>Toybox {$version}</a></span>";
        });
    }
}