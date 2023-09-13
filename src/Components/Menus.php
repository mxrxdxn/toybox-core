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

    /**
     * Returns or prints a menu.
     *
     * @param string $location The value for `theme_location`.
     * @param array  $params   The parameters to override. Note that `theme_location` and `return` cannot be overridden.
     * @param bool   $return   Return the menu as a string, or print it.
     *
     * @return string|bool
     */
    public static function get(string $location, array $params = [], bool $return = true): string|bool
    {
        if (empty($params)) {
            $params = [
                "theme_location"  => $location,
                "container_class" => "nav-container",
                "echo"            => false,
            ];
        } else {
            $params["theme_location"] = $location;
            $params["echo"]           = false;
        }

        $menu = wp_nav_menu($params);

        if ($return === true) {
            return $menu;
        }

        echo $menu;

        return true;
    }
}