<?php

namespace Toybox\Core\Components;

class Settings
{
    /**
     * Registers the theme's option pages using ACF. These pages can then be populated via ACF.
     * If ACF is not installed, nothing will fire.
     *
     * @param array $options
     *
     * @return void
     */
    public static function registerPage(array $options): void
    {
        // Intelligently work out if this is a subpage.
        $subPage = array_key_exists("parent_slug", $options) && ! empty($options["parent_slug"]);

        if ($subPage === false) {
            if (function_exists('acf_add_options_page')) {
                // Main Settings Page
                acf_add_options_page($options);
            }
        } else {
            if (function_exists('acf_add_options_sub_page')) {
                acf_add_options_sub_page($options);
            }
        }
    }
}