<?php

namespace Toybox\Core\Components;

class Globals
{
    /**
     * Transient key used for storing global settings in the cache.
     */
    public const string SETTINGS_TRANSIENT = "_toybox_global_settings";

    /**
     * Fetch the global settings.
     *
     * @param bool $cached Use a cached version of the settings for performance benefits.
     *
     * @return array
     */
    public static function settings(bool $cached = true): array
    {
        $getSettings = function () {
            // Get global settings
            return get_field("global", "options") ?? [];
        };

        if ($cached === false) {
            return $getSettings();
        }

        return Transient::remember(static::SETTINGS_TRANSIENT, function () use ($getSettings) {
            return $getSettings();
        }, now()->addDay());
    }
}
