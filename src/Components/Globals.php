<?php

namespace Toybox\Core\Components;

use Carbon\Carbon;

class Globals
{
    /**
     * Retrieves global settings data, optionally using a cached version.
     *
     * @param bool $cached Determines whether to use the cached version of the data. If false, fresh data will be fetched.
     *
     * @return array The global settings data.
     */
    public static function get(bool $cached = true): array
    {
        $getGlobals = function () {
            // Get header code from settings
            return get_field("global", "options") ?? [];
        };

        if ($cached === false) {
            return $getGlobals();
        }

        return Transient::remember("_toybox_globals", function () use ($getGlobals) {
            return $getGlobals();
        }, now()->addDay());
    }

    /**
     * Fetch the footer include code.
     *
     * @param bool $cached Use a cached version of the code for performance benefits.
     *
     * @return string
     */
    public static function footerCode(bool $cached = true): string
    {
        $getCode = function () {
            // Get footer code from settings
            return get_field("footer", "options")["foot_include"];
        };

        // Get the cached version
        if ($cached) {
            // Check if the transient is set
            $cachedCode = Transient::get("_toybox_foot_include");

            // Set the transient
            if ($cachedCode === false) {
                $cachedCode = $getCode();

                Transient::set("_toybox_foot_include", $cachedCode, Carbon::now()->addDay());
            }

            return $cachedCode;
        }

        return $getCode();
    }
}
