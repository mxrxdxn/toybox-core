<?php

namespace Toybox\Core\Components;

class PostType
{
    /**
     * Autoload custom post types from the /post-types directory.
     *
     * @return void
     */
    public static function boot(): void
    {
        if (function_exists('register_post_type')) {
            $path = get_template_directory() . "/post-types";

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
     * Shorthand function for `get_post_type()`.
     *
     * Retrieves the post type of the current post or of a given post.
     *
     * @param int|WP_Post|null $post Post ID or post object. Default is global $post.
     *
     * @return string|false Post type on success, false on failure.
     */
    public static function get(int|WP_Post|null $post = null): string|false
    {
        return get_post_type($post);
    }
}
