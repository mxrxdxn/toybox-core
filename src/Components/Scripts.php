<?php

namespace Toybox\Core\Components;

class Scripts
{
    /**
     * Adds a defer attribute to specified script tags in WordPress.
     *
     * @param array $handles An array of script handles that should have the defer attribute added.
     *
     * @return void
     */
    public static function defer(array $handles): void
    {
        add_filter('script_loader_tag', function ($tag, $handle, $src) use ($handles) {
            if (in_array($handle, $handles, true)) {
                return '<script src="' . esc_url($src) . '" defer></script>';
            }

            return $tag;
        }, 10, 3);
    }
}
