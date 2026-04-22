<?php

namespace Toybox\Core\Components;

class jQuery
{
    /**
     * Removes the dependency on jQuery Migrate for frontend scripts.
     *
     * This method hooks into the `wp_default_scripts` action and modifies the `jquery` script's
     * dependencies to exclude `jquery-migrate`. The modification is applied only for frontend scripts
     * and does not affect the admin area.
     *
     * @return void
     */
    public static function removeMigrate(): void
    {
        add_action('wp_default_scripts', function ($scripts) {
            if (is_admin()) {
                return;
            }

            if (isset($scripts->registered['jquery'])) {
                $script = $scripts->registered['jquery'];

                if ($script->deps) {
                    $script->deps = array_diff($script->deps, ['jquery-migrate']);
                }
            }
        });
    }
}
