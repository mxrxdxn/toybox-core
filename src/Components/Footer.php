<?php

namespace Toybox\Core\Components;

class Footer
{
    /**
     * Fetch the footer include code.
     *
     * @param bool $cached Use a cached version of the code for performance benefits.
     *
     * @return string
     */
    public static function code(bool $cached = true): string
    {
        $getCode = function () {
            // Get header code from settings
            return get_field("footer", "options")["foot_include"];
        };

        if ($cached === false) {
            return $getCode();
        }

        return Transient::remember("_toybox_foot_include", function () use ($getCode) {
            return $getCode();
        }, now()->addDay());
    }
}
