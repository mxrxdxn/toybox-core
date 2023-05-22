<?php

namespace Toybox\Core\Components;

class Excerpts
{
    /**
     * Override the default excerpt length.
     *
     * @param int $newLength
     *
     * @return void
     */
    public static function length(int $newLength): void
    {
        add_filter('excerpt_length', function ($length) use ($newLength) {
            return $newLength;
        });
    }

    /**
     * Override the default excerpt ending.
     *
     * @param string $ending
     *
     * @return void
     */
    public static function ending(string $ending): void
    {
        add_filter('excerpt_more', function ($more) use ($ending) {
            return $ending;
        });
    }
}