<?php

namespace Toybox\Core\Components;

use WP_Post;

class Post
{
    /**
     * Fetches a post by its ID.
     *
     * @param int $postID
     *
     * @return WP_Post
     */
    public static function get(int $postID): WP_Post
    {
        return get_post($postID);
    }
}
