<?php

namespace Toybox\Core\Components;

class Menus
{
    /**
     * Registers menu locations and names in WordPress.
     *
     * Uses the same syntax as the native `register_nav_menus` function:
     *
     * ```
     * [
     *     'menu_location' => __("Menu Name", "text-domain")
     * ]
     * ```
     *
     * Text domain isn't required - in fact, you can completely omit the __()
     * call and just pass in a string if you want.
     *
     * @param array $menus
     *
     * @return void
     */
    public static function set(array $menus = []): void
    {
        // Register menus
        add_action("after_setup_theme", function () use ($menus) {
            // Register menus
            register_nav_menus($menus);
        });
    }
}