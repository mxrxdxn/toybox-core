<?php

namespace Toybox\Core\Components;

class Author
{
    /**
     * Removes the permalink "front" segment (e.g., '/articles/') from author URLs,
     * ensuring that author URLs do not include the "front" part of the permalink
     * structure while leaving posts under the front unaffected.
     *
     * This adjustment is applied to both rewrite rules and author link output.
     *
     * @return void
     */
    public static function removeFrontUrl(): void
    {
        /**
         * Remove the permalink "front" (e.g. /articles/) from author URLs only,
         * while leaving posts under the front.
         */
        add_filter('author_rewrite_rules', function (array $rules): array {
            global $wp_rewrite;

            // $wp_rewrite->front includes leading/trailing slash, e.g. '/articles/' or 'index.php/'
            $front          = $wp_rewrite->front ?? '';
            $front_no_slash = ltrim($front, '/');

            // If no meaningful front ('' or '/'), nothing to strip.
            if ($front === '' || $front === '/') {
                return $rules;
            }

            $new = [];
            foreach ($rules as $regex => $query) {
                // WP rewrite rule keys don't start with a leading slash.
                // Strip the front ONLY when it actually prefixes the rule.
                $new_regex       = preg_replace('#^' . preg_quote($front_no_slash, '#') . '#', '', $regex, 1);
                $new[$new_regex] = $query;
            }

            return $new;
        });

        /**
         * Fix the *output* of author links so they don’t show the front either.
         */
        add_filter('author_link', function (string $link): string {
            global $wp_rewrite;

            $front = $wp_rewrite->front ?? '';
            if ($front === '' || $front === '/') {
                return $link; // Nothing to change.
            }

            // Normalize: remove leading/trailing slashes for building the segment.
            $front_path = trim($front, '/');

            // Replace “…/{front}/author/…” with “…/author/…”
            // Works for things like '/articles/author/', 'index.php/author/', etc.
            $needle = '/' . $front_path . '/author/';
            $link   = str_replace($needle, '/author/', $link);

            // Also handle rare cases where $front has no trailing slash in the built URL.
            $needle2 = '/' . rtrim($front_path, '/') . 'author/';
            if ($needle2 !== $needle) {
                $link = str_replace($needle2, '/author/', $link);
            }

            return $link;
        }, 10, 1);

    }
}
