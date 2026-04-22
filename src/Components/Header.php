<?php

namespace Toybox\Core\Components;

class Header
{
    /**
     * Cleans up unnecessary meta elements from the WordPress head section upon initialization.
     *
     * @return void
     */
    public static function cleanup(): void
    {
        add_action('init', function () {
            remove_action('wp_head', 'rsd_link');
            remove_action('wp_head', 'wlwmanifest_link');
            remove_action('wp_head', 'wp_generator');
            remove_action('wp_head', 'rest_output_link_wp_head');
            remove_action('wp_head', 'wp_shortlink_wp_head');
            remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
        });
    }

    /**
     * Fetch the header include code.
     *
     * @param bool $cached Use a cached version of the code for performance benefits.
     *
     * @return string
     */
    public static function code(bool $cached = true): string
    {
        $getCode = function () {
            // Get header code from settings
            return get_field("header", "options")["head_include"];
        };

        if ($cached === false) {
            return $getCode();
        }

        return Transient::remember("_toybox_head_include", function () use ($getCode) {
            return $getCode();
        }, now()->addDay());
    }
}
