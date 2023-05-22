<?php

namespace Toybox\Core\Components;

class Login
{
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
     * Sets the logo on the login page.
     *
     * @return void
     */
    public static function setLogo()
    {
        add_action('login_head', function () {
            $stylesheetDir = get_bloginfo('stylesheet_directory');

            $output = <<<OUTPUT
                <style>
                    h1 a {
                        width: 300px !important;
                        background-image: url({$stylesheetDir}/images/admin-logo.svg)  !important;
                        background-size: contain !important;
                    }
                </style>
            OUTPUT;

            echo $output;
        });
    }
}