<?php

namespace Toybox\Core\Components;

class Visitor
{
    /**
     * If it is the visitor's first visit to the website.
     *
     * @return bool
     */
    public static function firstVisit(): bool
    {
        if (isset($_COOKIE['_wp_first_time']) || User::loggedIn()) {
            return false;
        }

        return true;
    }
}
