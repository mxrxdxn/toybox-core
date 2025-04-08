<?php

namespace Toybox\Core\Components\Google;

class Lighthouse
{

    /**
     * Determines whether the "Lighthouse" string is present in the user agent.
     *
     * @return bool Returns true if "Lighthouse" is detected in the user agent, false otherwise.
     */
    public static function detected(): bool
    {
        $userAgent = $_SERVER['HTTP_USER_AGENT'];

        return str_contains($userAgent, "Lighthouse");
    }
}
