<?php

namespace Toybox\Core\Components;

class Pingbacks
{
    /**
     * Prevents self-pingbacks by removing links to the site's own URL during the pre-ping process.
     *
     * This method hooks into the "pre_ping" action, iterating through the list of pingback links
     * and removing any links that point to the site's own home URL.
     *
     * @return void
     */
    public static function disableSelfPingbacks(): void
    {
        add_action("pre_ping", function (&$links) {
            $home = home_url();

            foreach ($links as $l => $link) {
                if (str_starts_with($link, $home)) unset($links[$l]);
            }
        });
    }
}
