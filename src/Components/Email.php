<?php

namespace Toybox\Core\Components;

class Email
{
    /**
     * Shorthand function for `antispambot()`.
     *
     * Converts email addresses characters to HTML entities to block spam bots.
     *
     * @param string $email       Email address.
     * @param int    $hexEncoding Set to 1 to enable hex encoding.
     *
     * @return string
     */
    public static function mask(string $email, int $hexEncoding): string
    {
        return antispambot($email, $hexEncoding);
    }
}
