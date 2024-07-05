<?php

namespace Toybox\Core\Components;

use Carbon\Carbon;

class Globals
{
    /**
     * Fetch the header include code.
     *
     * @param bool $cached Use a cached version of the code for performance benefits.
     *
     * @return string
     */
    public static function headerCode(bool $cached = true): string
    {
        $getCode = function () {
            // Get header code from settings
            return get_field("header", "options")["head_include"];
        };

        // Get the cached version
        if ($cached) {
            // Check if the transient is set
            $cachedCode = Transient::get("_toybox_head_include");

            // Set the transient
            if ($cachedCode === false) {
                $cachedCode = $getCode();

                Transient::set("_toybox_head_include", $cachedCode, Carbon::now()->addDay());
            }

            return $cachedCode;
        }

        return $getCode();
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
