<?php

namespace Toybox\Core\Components;

class Path
{
    /**
     * Shorthand function for `get_home_path()`.
     *
     * Gets the absolute filesystem path to the root of the WordPress installation.
     *
     * @return string Full filesystem path to the root of the WordPress installation.
     */
    public static function home(): string
    {
        return get_home_path();
    }

    /**
     * Shorthand function for `get_stylesheet_directory()`.
     *
     * Retrieves stylesheet directory path for the active theme.
     *
     * @return string Path to active theme’s stylesheet directory.
     */
    public static function stylesheetDirectory(): string
    {
        return get_stylesheet_directory();
    }

    /**
     * Shorthand function for `get_template_directory()`.
     *
     * Retrieves template directory path for the active theme.
     *
     * @return string Path to active theme’s template directory.
     */
    public static function templateDirectory(): string
    {
        return get_template_directory();
    }

    /**
     * Shorthand function for `get_theme_file_path()`.
     *
     * Retrieves the path of a file in the theme.
     *
     * Searches in the stylesheet directory before the template directory so themes which inherit from a parent theme
     * can just override one file.
     *
     * @param string $file File to search for in the stylesheet directory.
     *
     * @return string The path of the file.
     */
    public static function themeFile(string $file = ''): string
    {
        return get_theme_file_path($file);
    }

    /**
     * Shorthand function for `plugin_dir_path()`.
     *
     * Get the filesystem directory path (with trailing slash) for the plugin __FILE__ passed in.
     *
     * @param string $file The filename of the plugin (__FILE__).
     *
     * @return string The filesystem path of the directory that contains the plugin.
     */
    public static function pluginDirectory(string $file): string
    {
        return plugin_dir_path($file);
    }
}
