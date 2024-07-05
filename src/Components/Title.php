<?php

namespace Toybox\Core\Components;

class Title
{
    /**
     * Override the page title.
     *
     * @param string $newTitle
     * @param bool   $appendSiteName
     *
     * @return void
     */
    public static function override(string $newTitle, bool $appendSiteName = true): void
    {
        $override = function ($title) use ($newTitle, $appendSiteName) {
            if ($appendSiteName) {
                $blogName = get_bloginfo("name");

                return "{$newTitle} | {$blogName}";
            }

            return $newTitle;
        };

        add_filter("pre_get_document_title", $override);
        add_filter("wpseo_title", $override);
    }
}
