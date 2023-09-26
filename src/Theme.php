<?php

namespace Toybox\Core;

use Exception;
use Toybox\Core\Components\ACF;
use Toybox\Core\Components\Admin;
use Toybox\Core\Components\AdminBar;
use Toybox\Core\Components\Login;
use Toybox\Core\Components\Misc;
use Toybox\Core\Components\Pattern;
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
    const VERSION = "2.7.0";

    /**
     * This directory.
     */
    const CORE = __DIR__;

    /**
     * Boots the theme.
     *
     * @return void
     * @throws Exception
     */
    public static function boot(): void
    {
        // Theme setup
        self::setup();

        // Enqueue styles and scripts
        self::scripts();

        // Register blocks
        self::registerBlocks();

        // Register post types
        self::registerPostTypes();

        // Register ACF fields
        ACF::loadBlockACFFields();
        ACF::setPaths();

        // Register shortcodes
        self::registerShortcodes();

        // Load snippets
        self::loadSnippets();
    }

    /**
     * Runs actions in the "after_setup_theme" hook.
     *
     * @return void
     * @throws Exception
     */
    private static function setup(): void
    {
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

        // Deregister core block patterns
        Pattern::deregisterDefaultPatterns();

        // Register our default pattern
        Pattern::registerCategory("Theme Patterns", "theme-patterns");

        Misc::optimizeTables();
        Admin::hideWelcomePanel();
        Admin::disableUpdateNag();
        Admin::setFooterText();
        AdminBar::setLogo();
        Login::maskErrors();
        Login::setLogo();
    }

    /**
     * Enqueues any styles or scripts required by the theme.
     *
     * @return void
     * @throws Exception
     */
    private static function scripts(): void
    {
        add_action("wp_enqueue_scripts", function () {
            wp_enqueue_style('critical', mix('/assets/css/critical.css'));
        });
    }

    /**
     * Autoload blocks from the /blocks directory.
     *
     * @return void
     */
    private static function registerBlocks(): void
    {
        $path = get_theme_file_path() . "/blocks";

        if (file_exists($path)) {
            foreach (glob("{$path}/*") as $blockDir) {
                // Load the block
                add_action("init", function () use ($blockDir) {
                    // We use a file existence check here as we may be supporting newer block types.
                    if (file_exists("{$blockDir}/block.json")) {
                        require_once("{$blockDir}/init.php");
                    } else {
                        // Perform an additional check to ensure we have ACF installed.
                        if (function_exists('acf_register_block_type')) {
                            require_once("{$blockDir}/init.php");
                        }
                    }
                }, 5);
            }
        }
    }

    /**
     * Autoload custom post types from the /post-types directory.
     *
     * @return void
     */
    private static function registerPostTypes(): void
    {
        if (function_exists('register_post_type')) {
            $path = get_theme_file_path() . "/post-types";

            if (file_exists($path)) {
                foreach (glob("{$path}/*.php") as $postType) {
                    // Load the post type
                    add_action("init", function () use ($postType) {
                        require_once("{$postType}");
                    }, 0);
                }
            }
        }
    }

    /**
     * Autoload shortcodes from the /shortcodes directory.
     *
     * @return void
     */
    private static function registerShortcodes(): void
    {
        if (function_exists('add_shortcode')) {
            $path = get_theme_file_path() . "/shortcodes";

            if (file_exists($path)) {
                foreach (glob("{$path}/*") as $shortcodeDir) {
                    // Load the shortcode
                    add_action("init", function () use ($shortcodeDir) {
                        require_once("{$shortcodeDir}/init.php");
                    });
                }
            }
        }
    }

    /**
     * Allows loading of "snippets" - small bits of sharable code that can be dropped into any Toybox installation.
     *
     * @return void
     */
    private static function loadSnippets(): void
    {
        $path = get_theme_file_path() . "/snippets";

        if (file_exists($path)) {
            foreach (glob("{$path}/*.php") as $snippet) {
                require_once($snippet);
            }
        }
    }
}