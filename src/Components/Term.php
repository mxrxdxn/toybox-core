<?php

namespace Toybox\Core\Components;

use WP_Term;

class Term
{
    /**
     * Find the "level" of a term in a hierarchical taxonomy.
     *
     * @param WP_Term $term
     *
     * @return int
     */
    public static function level(WP_Term $term): int
    {
        // The parent term ID
        $parent = $term->parent;

        // Initial level is always 1
        $level = 1;

        // Loop over the terms until we get to parent 0.
        while ($parent !== 0) {
            $term = get_term($term->parent, $term->taxonomy);
            $level++;
            $parent = $term->parent;
        }

        return $level;
    }

    /**
     * Figure out if a term is "inside" (or a child of) another term in a hierarchical taxonomy.
     *
     * @param WP_Term     $term
     * @param WP_Term|int $in
     *
     * @return bool
     */
    public static function in(WP_Term $term, WP_Term|int $in): bool
    {
        // Get the parent
        $parent = $term->parent;

        // We only need an ID
        if (! is_int($in)) {
            $in = $in->term_id;
        }

        // Loop all the parents
        while ($parent !== 0) {
            $term   = get_term($term->parent, $term->taxonomy);
            $parent = $term->parent;

            if ($term->term_id === $in) {
                return true;
            }
        }

        return $term->term_id === $in;
    }
}
