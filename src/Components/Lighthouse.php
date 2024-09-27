<?php

namespace Toybox\Core\Components;

class Lighthouse
{
    /**
     * Detect if the page is currently being processed by Pagespeed (otherwise known as Lighthouse).
     *
     * @return bool
     */
    public static function detected(): bool
    {
        $userAgent = $_SERVER['HTTP_USER_AGENT'];

        return str_contains($userAgent, "Lighthouse");
    }
}
