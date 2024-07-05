<?php

namespace Toybox\Core\Components;

class URI
{
    /**
     * Shorthand function for `home_url()`.
     *
     * Retrieves the URL for the current site where the front end is accessible.
     *
     * Returns the ‘home’ option with the appropriate protocol. The protocol will be ‘https’ if is_ssl() evaluates to
     * true; otherwise, it will be the same as the ‘home’ option.
     *
     * If $scheme is ‘http’ or ‘https’, is_ssl() is overridden.
     *
     * @param string      $path   Path relative to the home URL.
     * @param string|null $scheme Scheme to give the home URL context. Accepts 'http', 'https', 'relative', 'rest', or
     *                            null.
     *
     * @return string Home URL link with optional path appended.
     */
    public static function home(string $path = '', string|null $scheme = null): string
    {
        return home_url($path, $scheme);
    }

    /**
     * Shorthand function for `admin_url()`.
     *
     * Retrieves the URL to the admin area for the current site.
     *
     * @param string $path   Path relative to the admin URL.
     * @param string $scheme The scheme to use. Default is 'admin', which obeys force_ssl_admin() and is_ssl().
     *                       'http' or 'https' can be passed to force those schemes.
     *
     * @return string Admin URL link with optional path appended.
     */
    public static function admin(string $path = '', string $scheme = 'admin'): string
    {
        return admin_url($path, $scheme);
    }

    /**
     * Shorthand function for `get_site_url()`.
     *
     * Retrieves the URL for a given site where WordPress application files (e.g. wp-blog-header.php or the wp-admin/
     * folder) are accessible.
     *
     * Returns the ‘site_url’ option with the appropriate protocol, ‘https’ if is_ssl() and ‘http’ otherwise. If $scheme
     * is ‘http’ or ‘https’, is_ssl() is overridden.
     *
     * @param int|null    $blog_id Site ID. Default null (current site).
     * @param string      $path    Path relative to the site URL.
     * @param string|null $scheme  Scheme to give the site URL context. Accepts 'http', 'https', 'login', 'login_post', 'admin', or 'relative'.
     *
     * @return string Site URL link with optional path appended.
     */
    public static function site(int|null $blog_id = null, string $path = '', string|null $scheme = null): string
    {
        return get_site_url($blog_id, $path, $scheme);
    }

    /**
     * Shorthand function for `get_stylesheet_directory_uri()`.
     *
     * Retrieves stylesheet directory URI for the active theme.
     *
     * @return string URI to active theme’s stylesheet directory.
     */
    public static function stylesheetDirectory(): string
    {
        return get_stylesheet_directory_uri();
    }

    /**
     * Shorthand function for `get_template_directory_uri()`.
     *
     * Retrieves template directory URI for the active theme.
     *
     * @return string URI to active theme’s template directory.
     */
    public static function templateDirectory(): string
    {
        return get_template_directory_uri();
    }

    /**
     * Shorthand function for `get_theme_file_uri()`.
     *
     * Retrieves the URL of a file in the theme.
     *
     * Searches in the stylesheet directory before the template directory so themes which inherit from a parent theme
     * can just override one file.
     *
     * @param string $file File to search for in the stylesheet directory.
     *
     * @return string The URL of the file.
     */
    public static function themeFile(string $file = ""): string
    {
        return get_theme_file_uri($file);
    }

    /**
     * Shorthand function for `plugin_dir_url()`.
     *
     * Get the URL directory path (with trailing slash) for the plugin __FILE__ passed in.
     *
     * @param string $file The filename of the plugin (__FILE__).
     *
     * @return string The URL path of the directory that contains the plugin.
     */
    public static function pluginDirectory(string $file): string
    {
        return plugin_dir_url($file);
    }
}
