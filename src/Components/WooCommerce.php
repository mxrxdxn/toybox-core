<?php

namespace Toybox\Core\Components;

class WooCommerce
{
    /**
     * Boots the WooCommerce environment.
     *
     * @return void
     */
    public static function boot(): void
    {
        // Enable Gutenberg
        self::enableGutenberg();
    }

    /**
     * Enables Gutenberg on WooCommerce pages.
     *
     * @return void
     */
    private static function enableGutenberg(): void
    {
        // Enable Gutenberg for WooCommerce
        add_filter("use_block_editor_for_post_type", function ($can_edit, $post_type) {
            if ($post_type === "product") {
                $can_edit = true;
            }

            return $can_edit;
        }, 10, 2);

        // Enable taxonomy fields for WooCommerce with Gutenberg on
        add_filter("woocommerce_taxonomy_args_product_cat", function ($args) {
            $args['show_in_rest'] = true;
            return $args;
        });

        add_filter('woocommerce_taxonomy_args_product_tag', function ($args) {
            $args['show_in_rest'] = true;
            return $args;
        });
    }
}
