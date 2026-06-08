<?php

namespace Toybox\Core\Components;

class Header
{
    /**
     * Transient key used for storing header settings in the cache.
     */
    public const string SETTINGS_TRANSIENT = "_toybox_header_settings";

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
     * Fetch the header settings.
     *
     * @param bool $cached Use a cached version of the settings for performance benefits.
     *
     * @return array
     */
    public static function settings(bool $cached = true): array
    {
        $getSettings = function () {
            // Get header settings
            return get_field("header", "options") ?? [];
        };

        if ($cached === false) {
            return $getSettings();
        }

        return Transient::remember(static::SETTINGS_TRANSIENT, function () use ($getSettings) {
            return $getSettings();
        }, now()->addDay());
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
        $settings = static::settings($cached);

        if (array_key_exists("head_include", $settings)) {
            return $settings["head_include"];
        }

        return "";
    }
}
