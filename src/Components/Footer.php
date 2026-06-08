<?php

namespace Toybox\Core\Components;

class Footer
{
    /**
     * Transient key used for storing footer settings in the cache.
     */
    public const string SETTINGS_TRANSIENT = "_toybox_footer_settings";

    /**
     * Fetch the footer settings.
     *
     * @param bool $cached Use a cached version of the settings for performance benefits.
     *
     * @return array
     */
    public static function settings(bool $cached = true): array
    {
        $getSettings = function () {
            // Get footer settings
            return get_field("footer", "options") ?? [];
        };

        if ($cached === false) {
            return $getSettings();
        }

        return Transient::remember(static::SETTINGS_TRANSIENT, function () use ($getSettings) {
            return $getSettings();
        }, now()->addDay());
    }

    /**
     * Fetch the footer include code.
     *
     * @param bool $cached Use a cached version of the code for performance benefits.
     *
     * @return string
     */
    public static function code(bool $cached = true): string
    {
        $settings = static::settings($cached);

        if (array_key_exists("foot_include", $settings)) {
            return $settings["foot_include"];
        }

        return "";
    }
}
