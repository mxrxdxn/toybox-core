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
     * Loads ACF fields from block directories.
     *
     * @return void
     */
    public static function loadBlockACFFields(): void
    {
        $path = get_theme_file_path() . "/blocks";

        if (file_exists($path)) {
            foreach (glob("{$path}/*") as $blockDir) {
                // Load the ACF JSON
                add_filter('acf/settings/load_json', function ($paths) use ($blockDir) {
                    // Add the path
                    $paths[] = "{$blockDir}/acf-json";

                    return $paths;
                });
            }
        }
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
        add_filter("acf/json/save_paths", function ($paths, $post) {
            // If we're saving a block's settings, save to the block itself.
            if (
                is_array($post["location"])
                && array_key_exists(0, $post['location'])
                && is_array($post["location"][0])
                && array_key_exists(0, $post['location'][0])
                && is_array($post["location"][0][0])
                && array_key_exists("param", $post["location"][0][0])
                && $post["location"][0][0]["param"] === "block"
                && array_key_exists("value", $post["location"][0][0])
            ) {
                $blockName = str_ireplace("toybox/", "", $post["location"][0][0]["value"]);
                $path      = get_theme_file_path() . "/blocks/{$blockName}/acf-json";

                $paths = [$path];
            }

            return $paths;
        }, 10, 2);
    }

    /**
     * Set the save path for ACF post types.
     * @return void
     */
    public static function setPostTypeSavePath(): void
    {
        add_filter("acf/settings/save_json/type=acf-post-type", function ($path) {
            $path = get_theme_file_path() . '/post-types';

            if (! file_exists($path)) {
                mkdir($path, 0777, true);
            }

            return $path;
        });
    }

    /**
     * Set the load path for ACF post types.
     * @return void
     */
    public static function setPostTypeLoadPath(): void
    {
        $path = get_theme_file_path() . "/post-types";

        if (file_exists($path)) {
            // Load the ACF JSON
            add_filter('acf/settings/load_json', function ($paths) use ($path) {
                // Add the path
                $paths[] = "{$path}";

                return $paths;
            });
        }
    }

    /**
     * Set the save path for ACF taxonomies.
     * @return void
     */
    public static function setTaxonomySavePath(): void
    {
        add_filter("acf/settings/save_json/type=acf-taxonomy", function ($path) {
            $path = get_theme_file_path() . '/taxonomies';

            if (! file_exists($path)) {
                mkdir($path, 0777, true);
            }

            return $path;
        });
    }

    /**
     * Set the load path for ACF setting pages.
     * @return void
     */
    public static function setTaxonomyLoadPath(): void
    {
        $path = get_theme_file_path() . "/taxonomies";

        if (file_exists($path)) {
            // Load the ACF JSON
            add_filter('acf/settings/load_json', function ($paths) use ($path) {
                // Add the path
                $paths[] = "{$path}";

                return $paths;
            });
        }
    }

    /**
     * Set the save path for ACF setting pages.
     * @return void
     */
    public static function setOptionsPageSavePath(): void
    {
        add_filter("acf/settings/save_json/type=acf-ui-options-page", function ($path) {
            $path = get_theme_file_path() . '/options-pages';

            if (! file_exists($path)) {
                mkdir($path, 0777, true);
            }

            return $path;
        });
    }

    /**
     * Set the load path for ACF setting pages.
     * @return void
     */
    public static function setOptionsPageLoadPath(): void
    {
        $path = get_theme_file_path() . "/options-pages";

        if (file_exists($path)) {
            // Load the ACF JSON
            add_filter('acf/settings/load_json', function ($paths) use ($path) {
                // Add the path
                $paths[] = "{$path}";

                return $paths;
            });
        }
    }

    /**
     * Shorthand function to register all paths.
     * @return void
     */
    public static function setPaths(): void
    {
        // Post Types
        static::setPostTypeSavePath();
        static::setPostTypeLoadPath();

        // Taxonomies
        static::setTaxonomySavePath();
        static::setTaxonomyLoadPath();

        // Options Pages
        static::setOptionsPageSavePath();
        static::setOptionsPageLoadPath();
    }
}