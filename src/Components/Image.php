<?php

namespace Toybox\Core\Components;

class Image
{
    /**
     * Generates a responsive image tag with `srcset` and `sizes` attributes
     * for a given WordPress attachment ID.
     *
     * @param int    $attachmentID The ID of the WordPress media attachment.
     * @param array  $classes      Classes to apply to the image tag.
     * @param string $size         The image size to fetch (e.g., "thumbnail", "medium", "full").
     *
     * @return string The responsive image HTML tag.
     */
    public static function makeResponsive(int $attachmentID, array $classes = ["toybox-responsive"], string $size = "full"): string
    {
        // Get the sizes and srcset
        $imageSizes  = wp_get_attachment_image_sizes($attachmentID, "full");
        $imageSrcset = wp_get_attachment_image_srcset($attachmentID, "full");

        // Return the responsive image
        return wp_get_attachment_image(
            $attachmentID,
            $size,
            false,
            [
                "class"  => implode(" ", $classes),
                "sizes"  => $imageSizes,
                "srcset" => $imageSrcset,
            ]
        );
    }

    /**
     * Generates a responsive image markup based on image data retrieved from ACF (Advanced Custom Fields).
     *
     * @param array  $image   The image array from ACF, expected to include an 'ID' key.
     * @param array  $classes An array of CSS classes to apply to the image. Defaults to ["toybox-responsive"].
     * @param string $size    The desired image size. Defaults to "full".
     *
     * @return string The responsive image HTML markup.
     */
    public static function makeResponsiveFromACF(array|false $image, array $classes = ["toybox-responsive"], string $size = "full"): string
    {
        if ($image === false) {
            return "";
        }

        // Get the image
        $attachmentID = $image['ID'];

        return static::makeResponsive($attachmentID, $classes, $size);
    }


}
