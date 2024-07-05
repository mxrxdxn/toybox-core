<?php

namespace Toybox\Core\Components;

class Embeds
{
    /**
     * Disables WordPress's native embed library from loading.
     *
     * @return void
     */
    public static function disable(): void
    {
        add_action('init', function () {
            if (! is_admin()) {
                wp_deregister_script('wp-embed');
            }
        });

        add_action('init', function () {
            remove_action('rest_api_init', 'wp_oembed_register_route');
            remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
            remove_action('wp_head', 'wp_oembed_add_discovery_links');
            remove_action('wp_head', 'wp_oembed_add_host_js');
            add_filter('embed_oembed_discover', '__return_false');
            add_filter('rewrite_rules_array', function ($rules) {
                foreach ($rules as $rule => $rewrite) {
                    if (str_contains($rewrite, 'embed=true')) {
                        unset($rules[$rule]);
                    }
                }

                return $rules;
            });
        }, 9999);
    }
}
