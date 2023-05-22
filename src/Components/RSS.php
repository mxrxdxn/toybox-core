<?php

namespace Toybox\Core\Components;

class RSS
{
    /**
     * Disable RSS feeds.
     *
     * @return void
     */
    public static function disable(): void
    {
        foreach (["do_feed", "do_feed_rdf", "do_feed_rss", "do_feed_rss2", "do_feed_atom"] as $hook) {
            add_action($hook, function () {
                wp_die(__('No feed available,please visit our <a href="' . get_bloginfo('url') . '">homepage</a>!'));
            }, 1);
        }
    }
}