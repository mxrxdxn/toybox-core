<?php

namespace Toybox\Core\Components;

class ACF
{
    /**
     * Sets the API key used in the ACF backend when displaying maps within custom fields.
     *
     * @param string|null $key
     *
     * @return void
     */
    public static function setMapsApiKey(string|null $key = null): void
    {
        add_filter('acf/fields/google_map/api', function ($api) use ($key) {
            if ($key === null) {
                $key = get_field("google_maps_api_key", "options");
            }

            $api['key'] = $key;

            return $api;
        });
    }

    /**
     * Sets the save point for a block.
     *
     * @param string $blockName
     *
     * @return void
     */
    public static function setSavePoint(string $blockName): void
    {
        // Set the filename
        add_filter('acf/json/save_file_name', function ($filename, $post, $load_path) {
            $filename = strtolower(slugify($post['title'])) . '.json';

            return $filename;
        }, 10, 3);

        // Set the path
        $name = "Block: {$blockName}";

        add_filter("acf/settings/save_json/name={$name}", function ($path) use ($blockName, $name) {
            $path = get_stylesheet_directory() . '/blocks/' . slugify($blockName) . '/acf-json';

            if (! file_exists($path)) {
                mkdir($path, 0777, true);
            }

            return $path;
        });
    }
}