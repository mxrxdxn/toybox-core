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
        add_filter('acf/settings/load_json', function (array $paths) {
            $themeJSON = get_stylesheet_directory() . '/acf-json';

            // Keep the normal theme-level JSON path.
            if (is_dir($themeJSON)) {
                $paths[] = $themeJSON;
            }

            // Also load from every block's own acf-json folder.
            $blocks_dir = get_stylesheet_directory() . '/blocks';

            if (is_dir($blocks_dir)) {
                $block_json_dirs = glob($blocks_dir . '/*/acf-json', GLOB_ONLYDIR);

                if (is_array($block_json_dirs)) {
                    foreach ($block_json_dirs as $dir) {
                        $paths[] = $dir;
                    }
                }
            }

            return array_values(array_unique($paths));
        });
    }

    public static function saveBlockACFFields(): void
    {
        add_filter('acf/settings/save_json', function () {
            $themeJSON = get_stylesheet_directory() . '/acf-json';

            // Make sure the default/fallback path exists.
            if (! is_dir($themeJSON)) {
                wp_mkdir_p($themeJSON);
            }

            $fieldGroup = self::getFieldGroupFromRequest();

            // Not saving a field group, or request structure not available:
            // fall back to the theme root acf-json.
            if (! $fieldGroup) {
                return $themeJSON;
            }

            $blockSlug = self::getBlockSlugFromFieldGroup($fieldGroup);

            // Non-block field group:
            // save to theme root acf-json.
            if (! $blockSlug) {
                return $themeJSON;
            }

            $blockJSON = get_stylesheet_directory() . '/blocks/' . $blockSlug . '/acf-json';

            if (! is_dir($blockJSON)) {
                wp_mkdir_p($blockJSON);
            }

            return $blockJSON;
        }, 10, 1);
    }

    /**
     * Sets the save point for a block.
     *
     * @deprecated since 3.0.0 - paths should auto-detect without needing this function.
     *
     * @param string $blockName DEPRECATED - The name of the block.
     *
     * @return void
     */
    public static function setSavePoint(string $blockName = ""): void
    {
        // Silence is golden
    }

    /**
     * Set the save path for ACF post types.
     * @return void
     */
    public static function setPostTypeSavePath(): void
    {
        add_filter("acf/settings/save_json/type=acf-post-type", function ($path) {
            $path = get_template_directory() . '/post-types';

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
        $path = get_template_directory() . "/post-types";

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
            $path = get_template_directory() . '/taxonomies';

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
        $path = get_template_directory() . "/taxonomies";

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
            $path = get_template_directory() . '/options-pages';

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
        $path = get_template_directory() . "/options-pages";

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

    /**
     * Enable the ACF shortcode.
     * @return void
     */
    public static function enableShortcode(): void
    {
        add_action("acf/init", function () {
            acf_update_setting("enable_shortcode", true);
        });
    }

    /**
     * Retrieve the field group data from the request.
     * Validates and processes the 'acf_field_group' field in the $_POST global variable.
     *
     * @return array|null Returns the processed field group as an array, or null if not present or invalid.
     */
    private static function getFieldGroupFromRequest(): ?array
    {
        if (empty($_POST['acf_field_group']) || ! is_array($_POST['acf_field_group'])) {
            return null;
        }

        return wp_unslash($_POST['acf_field_group']);
    }

    /**
     * Retrieves the block slug from an ACF field group configuration.
     *
     * This method analyzes the location rules of a given ACF field group
     * to determine whether it is associated with a specific block. If a block
     * location is found, it extracts and returns the block slug.
     *
     * @param array|string $fieldGroup The ACF field group configuration.
     *                                 It can be provided as an array or a serialized string.
     *
     * @return string|null The block slug if detected, or null if no block association is found.
     */
    private static function getBlockSlugFromFieldGroup(array|string $fieldGroup): string|null
    {
        if (empty($fieldGroup['location']) || ! is_array($fieldGroup['location'])) {
            return null;
        }

        foreach ($fieldGroup['location'] as $locationGroup) {
            if (! is_array($locationGroup)) {
                continue;
            }

            foreach ($locationGroup as $rule) {
                if (
                    ! is_array($rule) ||
                    empty($rule['param']) ||
                    $rule['param'] !== 'block' ||
                    empty($rule['operator']) ||
                    $rule['operator'] !== '==' ||
                    empty($rule['value'])
                ) {
                    continue;
                }

                $blockName = (string) $rule['value'];

                // ACF block location values are typically like "acf/my-block".
                if (strpos($blockName, 'acf/') === 0) {
                    return substr($blockName, 4);
                }

                // Fallback just in case.
                return sanitize_title($blockName);
            }
        }

        return null;
    }
}
