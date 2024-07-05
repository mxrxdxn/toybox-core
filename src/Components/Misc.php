<?php

namespace Toybox\Core\Components;

class Misc
{
    /**
     * WordPress, being WordPress, obviously has a filter to replace all instances of "Wordpress" with "WordPress".
     * It's totally unnecessary, and just means we're wasting resources, so we'll go ahead and de-register the filter.
     *
     * @return void
     */
    public static function disableCapitalPDangit(): void
    {
        foreach (['the_content', 'the_title', 'wp_title', 'document_title'] as $filter) {
            remove_filter($filter, 'capital_P_dangit', 11);
        }

        remove_filter('comment_text', 'capital_P_dangit', 31);
        remove_filter('widget_text_content', 'capital_P_dangit', 11);
    }

    /**
     * Hide the WordPress version number.
     *
     * @return void
     */
    public static function hideVersion(): void
    {
        add_filter('the_generator', function () {
            return "";
        });
    }

    /**
     * Adds support for additional file types in WordPress' media upload.
     *
     * @param array $mimeTypes
     *
     * @return void
     */
    public static function addFileSupport(array $mimeTypes): void
    {
        add_filter('upload_mimes', function ($mime_types) use ($mimeTypes) {
            foreach ($mimeTypes as $extension => $mimeType) {
                $mime_types[$extension] = $mimeType;
            }

            return $mime_types;
        }, 1, 1);
    }

    /**
     * Optimize tables after switching themes.
     *
     * @return void
     */
    public static function optimizeTables(): void
    {
        add_action('after_switch_theme', function () {
            global $wpdb;
            $wpdb->query("OPTIMIZE TABLE {$wpdb->prefix}posts");
            $wpdb->query("OPTIMIZE TABLE {$wpdb->prefix}comments");
            $wpdb->query("OPTIMIZE TABLE {$wpdb->prefix}options");
        });
    }

    /**
     * Set custom image sizes for media uploader.
     *
     * @param array $sizes
     *
     * @return void
     */
    public static function setImageSizes(array $sizes): void
    {
        add_action('after_setup_theme', function () use ($sizes) {
            foreach ($sizes as $size => $options) {
                add_image_size($size, $options['width'], $options['height'], $options['crop']);
            }
        });

        add_filter('image_size_names_choose', function ($sizesArray) use ($sizes) {
            $s = [];

            foreach ($sizes as $key => $options) {
                $s[$key] = __($options['name']);
            }

            return array_merge($sizesArray, $s);
        });
    }
}
