<?php

namespace Toybox\Core\Components;

class Shortcode
{
    /**
     * Shorthand function for `add_shortcode()`.
     *
     * Care should be taken through prefixing or other means to ensure that the shortcode tag being added is unique and
     * will not conflict with other, already-added shortcode tags. In the event of a duplicated tag, the tag loaded last
     * will take precedence.
     *
     * @param string   $code     Shortcode tag to be searched in post content.
     * @param Callable $callable The callback function to run when the shortcode is found.
     *                           Every shortcode callback is passed three parameters by default, including an array of
     *                           attributes ($atts), the shortcode content or null if not set ($content), and finally
     *                           the shortcode tag itself ($shortcode_tag), in that order.
     *
     * @return void
     */
    public static function add(string $code, \callable $callable): void
    {
        add_shortcode($code, $callable);
    }

    /**
     * Shorthand function for `shortcode_atts()`.
     *
     * Combines user attributes with known attributes and fill in defaults when needed.
     *
     * The pairs should be considered to be all the attributes which are supported by the caller and given as a list.
     * The returned attributes will only contain the attributes in the $pairs list.
     *
     * If the $attributes list has unsupported attributes, then they will be ignored and removed from the final returned list.
     *
     * @param array  $defaults   Entire list of supported attributes and their defaults.
     * @param array  $attributes User defined attributes in shortcode tag.
     * @param string $shortcode  The name of the shortcode, provided for context to enable filtering.
     *
     * @return array
     */
    public static function attributes(array $defaults, array $attributes, string $shortcode = ""): array
    {
        return shortcode_atts($defaults, $attributes, $shortcode);
    }
}
