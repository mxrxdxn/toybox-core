<?php

namespace Toybox\Core\Components;

use Toybox\Core\Theme;

class Login
{
    /**
     * Sets the logo on the login page.
     *
     * @return void
     */
    public static function boot()
    {
        // Mask errors
        self::maskErrors();

        add_action('login_head', function () {
            ob_start();
            require(Theme::CORE . "/stubs/Login.php");
            echo ob_get_clean();
        });

        add_filter('login_headerurl', function () {
            return home_url('/');
        });

        add_filter('login_headertext', function () {
            return get_bloginfo('name');
        });
    }

    /**
     * Hide the login error messages as they can be abused by hackers to retrieve a list of valid users/emails.
     *
     * @return void
     */
    public static function maskErrors(): void
    {
        add_filter('login_errors', function () {
            return "Please check your credentials and try again.";
        });
    }

    /**
     * Return whether we're on the login page.
     *
     * @return bool
     */
    public static function isLoginPage(): bool
    {
        return $GLOBALS['pagenow'] === "wp-login.php";
    }
}
