<?php

namespace Toybox\Core\Components;

class Archive
{
    /**
     * Allows archive pages to have their title overridden.
     *
     * @param string $postTypeName   The name of the post type.
     * @param string $newTitle       The new title for the page.
     * @param bool   $appendSiteName Whether to append the site name to the page title. Defaults to true, matching standard WordPress behaviour.
     *
     * @return void
     */
    public static function setMetaTitle(string $postTypeName, string $newTitle, bool $appendSiteName = true): void
    {
        add_filter("pre_get_document_title", function ($title) use ($postTypeName, $newTitle, $appendSiteName) {
            if (is_post_type_archive($postTypeName)) {
                return $newTitle . (($appendSiteName) ? " - " . get_bloginfo("name") : "");
            }

            return $title;
        }, 9999);
    }
}
