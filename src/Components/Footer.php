<?php

namespace Toybox\Core\Components;

class Footer
{
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

        return Transient::remember("_toybox_footer_settings", function () use ($getSettings) {
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
        return static::settings($cached)["foot_include"];
    }
}
