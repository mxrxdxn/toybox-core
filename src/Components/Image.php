<?php

namespace Toybox\Core\Components;

use WP_Post;

class Image
{
    /**
     * Generates a responsive image element using an attachment ID.
     *
     * @param int    $attachmentID The WordPress attachment ID for the image.
     * @param array  $classes      An array of CSS class names to include on the image element. Defaults to ["toybox-responsive"].
     * @param string $size         The size of the image to retrieve. Defaults to "full".
     * @param array  $attributes   Additional HTML attributes to include on the image element as key-value pairs. Defaults to an empty array.
     *
     * @return string The generated responsive image HTML element.
     */
    public static function makeResponsive(int $attachmentID, array $classes = ["toybox-responsive"], string $size = "full", array $attributes = []): string
    {
        // Get the sizes and srcset
        $imageSizes  = wp_get_attachment_image_sizes($attachmentID, "full");
        $imageSrcset = wp_get_attachment_image_srcset($attachmentID, "full");

        // Merge attributes
        $mergedAttributes = array_merge_recursive([
            "class"  => implode(" ", $classes),
            "sizes"  => $imageSizes,
            "srcset" => $imageSrcset,
        ], $attributes);

        // Return the responsive image
        return wp_get_attachment_image(
            $attachmentID,
            $size,
            false,
            $mergedAttributes,
        );
    }

    /**
     * Generates a responsive image element using information from an ACF image field.
     *
     * @param array|false $image      The ACF image array containing image data, or false if no image is provided.
     * @param array       $classes    An array of CSS class names to include on the image element. Defaults to ["toybox-responsive"].
     * @param string      $size       The size of the image to retrieve. Defaults to "full".
     * @param array       $attributes Additional HTML attributes to include on the image element as key-value pairs. Defaults to an empty array.
     *
     * @return string The generated responsive image HTML element, or an empty string if no image is provided.
     */
    public static function makeResponsiveFromACF(array|false $image, array $classes = ["toybox-responsive"], string $size = "full", array $attributes = []): string
    {
        if ($image === false) {
            return "";
        }

        // Get the image
        $attachmentID = $image['ID'];

        return static::makeResponsive($attachmentID, $classes, $size, $attributes);
    }

    /**
     * Generates a responsive image HTML string from the thumbnail of a given post.
     *
     * @param WP_Post|int|null $post       The post object, ID, or null from which the thumbnail is retrieved.
     * @param array            $classes    An array of CSS classes to be applied to the responsive image. Defaults to ["toybox-responsive"].
     * @param string           $size       The size of the thumbnail image. Defaults to "full".
     * @param array            $attributes Additional HTML attributes to include in the image tag. Defaults to an empty array.
     *
     * @return string The generated responsive image HTML string. Returns an empty string if no thumbnail is found.
     */
    public static function makeResponsiveFromThumbnail(WP_Post|int|null $post, array $classes = ["toybox-responsive"], string $size = "full", array $attributes = []): string
    {
        $thumbnailID = get_post_thumbnail_id($post);

        if ($thumbnailID === false) {
            return "";
        }

        // Generate the responsive image
        return static::makeResponsive($thumbnailID, $classes, $size, $attributes);
    }
}
