<?php

namespace Toybox\Core\Components;

class Globals
{
    /**
     * Fetch the header include code.
     *
     * @return string
     */
    public static function headerCode(): string
    {
        // Get header code from settings
        return get_field("header", "options")["head_include"];
    }

    /**
     * Fetch the footer include code.
     *
     * @return string
     */
    public static function footerCode(): string
    {
        // Get header code from settings
        return get_field("footer", "options")["foot_include"];
    }
}