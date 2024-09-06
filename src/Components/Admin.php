<?php

namespace Toybox\Core\Components;

use Toybox\Core\Theme;

class Admin
{
    /**
     * Boots the admin styles.
     *
     * @return void
     */
    public static function boot(): void
    {
        add_action("admin_head", function () {
            include_once(Theme::CORE . "/stubs/StyleVars.php");
        });
    }

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

    /**
     * Detects whether the current request is an admin request.
     *
     * @return bool
     */
    public static function isAdminRequest(): bool
    {
        /**
         * Get current URL.
         *
         * @link https://wordpress.stackexchange.com/a/126534
         */
        $currentUrl = home_url(add_query_arg(null, null));

        /**
         * Get admin URL and referrer.
         *
         * @link https://core.trac.wordpress.org/browser/tags/4.8/src/wp-includes/pluggable.php#L1076
         */
        $adminUrl = strtolower(admin_url());
        $referrer  = strtolower(wp_get_referer());

        /**
         * Check if this is a admin request. If true, it
         * could also be a AJAX request from the frontend.
         */
        if (0 === strpos($currentUrl, $adminUrl)) {
            /**
             * Check if the user comes from a admin page.
             */
            if (0 === strpos($referrer, $adminUrl)) {
                return true;
            } else {
                /**
                 * Check for AJAX requests.
                 *
                 * @link https://gist.github.com/zitrusblau/58124d4b2c56d06b070573a99f33b9ed#file-lazy-load-responsive-images-php-L193
                 */
                if (function_exists('wp_doing_ajax')) {
                    return ! wp_doing_ajax();
                } else {
                    return ! (defined('DOING_AJAX') && DOING_AJAX);
                }
            }
        } else {
            return false;
        }
    }
}
