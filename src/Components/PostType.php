<?php

namespace Toybox\Core\Components;

class PostType
{
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
