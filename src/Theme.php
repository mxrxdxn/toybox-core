<?php

namespace Toybox\Core;

use Exception;
use Toybox\Core\Components\ACF;
use Toybox\Core\Components\Admin;
use Toybox\Core\Components\AdminBar;
use Toybox\Core\Components\Blocks;
use Toybox\Core\Components\Customizer;
use Toybox\Core\Components\Login;
use Toybox\Core\Components\Misc;
use Toybox\Core\Components\Pattern;
use Toybox\Core\Components\PostType;
use Toybox\Core\Components\Styles;
use Toybox\Core\Components\Shortcode;
use Toybox\Core\Components\Snippets;
use Toybox\Core\Components\User;

// Disable file editing from wp-admin
if (! defined("DISALLOW_FILE_EDIT")) {
    define('DISALLOW_FILE_EDIT', true);
}

class Theme
{
    /**
     * The theme version.
     */
    const VERSION = "2.23.1";

    /**
     * This directory.
     */
    const CORE = __DIR__;

    /**
     * Boots the theme.
     *
     * @param bool $disableCritical If set to true, the critical style will not be enqueued.
     *
     * @return void
     * @throws Exception
     */
    public static function boot(bool $disableCritical = false): void
    {
        // Load snippets
        Snippets::boot();

        // Theme setup
        self::setup();

        // Enqueue styles and scripts
        Styles::boot($disableCritical);

        // Register blocks
        Blocks::boot();

        // Register post types
        PostType::boot();

        // Register ACF fields
        ACF::loadBlockACFFields();
        ACF::setPaths();

        // Register shortcodes
        Shortcode::boot();

        // Boot customizer sections
        Customizer::boot();

        // Boot admin styles
        Admin::boot();
    }

    /**
     * Runs actions in the "after_setup_theme" hook.
     *
     * @return void
     * @throws Exception
     */
    private static function setup(): void
    {
        // Toybox setup start hook
        do_action("toybox_setup_start");

        add_action("after_setup_theme", function () {
            // Enable custom logo
            add_theme_support('custom-logo');

            // Enable custom backgrounds
            add_theme_support('custom-background');

            // Add default posts and comments RSS feed links to <head>.
            add_theme_support('automatic-feed-links');

            // Enable support for post thumbnails and featured images.
            add_theme_support('post-thumbnails');

            // Add the editor stylesheet (includes some core Gutenberg fixes)
            add_theme_support('editor-styles');
            add_editor_style('assets/css/editor.css');

            // Add support for block styles
            add_theme_support('wp-block-styles');

            // Add support for responsive embeds
            add_theme_support('responsive-embeds');

            // Title tag support
            add_theme_support('title-tag');

            // HTML5 support
            add_theme_support('html5', ['comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script']);
        }, 2);

        // Enqueue the editor.js file when we're in the block editor.
        add_action('enqueue_block_editor_assets', function () {
            wp_enqueue_script('editor-js', mix('/assets/js/editor.js'), [], '1.0.0', 'true');
        });

        // Tweak ACF WYSIWYG
        add_filter('acf/fields/wysiwyg/toolbars', function ($toolbars) {
            // Edit the "Full" toolbar and add 'fontsizeselect' if not already present.
            if ((array_search('fontsizeselect', $toolbars['Full'][2])) !== true) {
                $toolbars['Full'][2][] = 'fontsizeselect';
            }

            return $toolbars;
        });

        // Load only the blocks required for the page
        add_filter('should_load_separate_core_block_assets', '__return_true');

        // Set the first visit cookie
        add_action("init", function () {
            if (isset($_COOKIE['_wp_first_time']) || User::loggedIn()) {
                return false;
            } else {
                // expires in 30 days.
                setcookie('_wp_first_time', 1, time() + (WEEK_IN_SECONDS * 4), COOKIEPATH, COOKIE_DOMAIN, false);

                return true;
            }
        });

        // Include the style vars inside wp_head().
        add_action("wp_head", function () {
            include_once(Theme::CORE . "/stubs/StyleVars.php");
        });

        // Deregister core block patterns
        Pattern::deregisterDefaultPatterns();

        // Register our default pattern
        Pattern::registerCategory("Theme Patterns", "theme-patterns");

        Misc::optimizeTables();
        Admin::hideWelcomePanel();
        Admin::disableUpdateNag();
        Admin::setFooterText();
        AdminBar::setLogo();
        Login::boot();

        // Toybox setup complete hook
        do_action("toybox_setup_complete");
    }
}
