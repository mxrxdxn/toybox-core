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

    /**
     * Calculates how long it takes to read an article, rounded up to the next minute.
     *
     * @param int   $post           The post's ID.
     * @param float $wordsPerMinute The words per minute score to use in the calculation. For reference, the average in
     *                              the Maxweb office is ~343.1.
     *
     * @return float
     */
    public static function calculateReadingSpeed(int $post, float $wordsPerMinute = 238): float
    {
        $post = static::get($post);

        // Get the total amount of words for a page
        $wordCount = str_word_count(strip_tags(\Toybox\Core\Components\Blocks::renderContentString($post->post_content)));

        // Calculate the read time in minutes & round it up for a buffer.
        return ceil($wordCount / $wordsPerMinute);
    }
}
