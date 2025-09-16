<?php

namespace Toybox\Core\Components;

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
            $stylesheetDir = get_bloginfo('stylesheet_directory');

            $output = <<<OUTPUT
                <style>
                    @media screen and (min-width: 1024px) {
                        body {
                            display:         flex;
                            align-items:     center;
                            justify-content: center;
                        }
                        
                        #login {
                            padding-top: 2rem;
                        }
                    }
                    
                    body {
                        background-image:    url({$stylesheetDir}/images/login-background.webp);
                        background-size:     cover;
                        background-position: center center;
                    }
                    
                    .language-switcher {
                        display: none;
                    }
                    
                    #login {
                        margin-right: 10vw;
                        border: 1px solid #c3c4c7;
                        background: #fff;
                        box-shadow: 0 1px 3px rgba(0,0,0,.04);
                    }
                    
                    .login form {
                        background: unset;
                        border: unset;
                        box-shadow: unset;
                    }
                    
                    h1 a {
                        width: 300px !important;
                        background-image: url({$stylesheetDir}/images/admin-logo.svg)  !important;
                        background-size: contain !important;
                    }
                    
                    .login h1 a {
                        height: 50px;
                    }
                </style>
            OUTPUT;

            echo $output;
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
