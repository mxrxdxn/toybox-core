<?php

namespace Toybox\Core\Components;

class Excerpts
{
    /**
     * Override the default excerpt length.
     *
     * @param int $newLength
     *
     * @return void
     */
    public static function length(int $newLength): void
    {
        add_filter('excerpt_length', function ($length) use ($newLength) {
            return $newLength;
        });
    }

    /**
     * Override the default excerpt ending.
     *
     * @param string $ending
     *
     * @return void
     */
    public static function ending(string $ending): void
    {
        add_filter('excerpt_more', function ($more) use ($ending) {
            return $ending;
        });
    }

    /**
     * Fetches a trimmed excerpt from either the excerpt field or from the post content if an exceprt hasn't been
     * created.
     *
     * @param \WP_Post|int|null $post
     *
     * @return string
     */
    public static function get(\WP_Post|int|null $post = null): string
    {
        if ($post === null) {
            $post = $GLOBALS['post'];
        }

        if ($post instanceof \WP_Post) {
            $excerpt = trim($post->post_excerpt);
        } else {
            $excerpt = trim(get_the_excerpt($post));
        }

        return wp_trim_excerpt($excerpt, $post);
    }
}
