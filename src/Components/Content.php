<?php

namespace Toybox\Core\Components;

class Content
{
    /**
     * Adds a filter to modify the content of posts by appending a "loading=lazy" attribute
     * to <img> and <iframe> tags, which enables the lazy loading of these elements.
     *
     * @return void
     */
    public static function lazyLoad(): void
    {
        add_filter('the_content', function ($content) {
            $content = preg_replace('/<img[^>]+>/', '<img loading="lazy" $0>', $content);
            return preg_replace('/<iframe(.*?)src=/i', '<iframe loading="lazy"$1src=', $content);
        });
    }
}
