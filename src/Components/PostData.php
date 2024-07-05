<?php

namespace Toybox\Core\Components;

class PostData
{
    /**
     * Shorthand function for `wp_reset_postdata()`.
     *
     * @return void
     */
    public static function reset(): void
    {
        wp_reset_postdata();
    }
}
