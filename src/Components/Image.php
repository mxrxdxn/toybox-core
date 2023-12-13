<?php

namespace Toybox\Core\Components;

class Image
{
    /**
     * Return a responsive image from an attachment ID.
     *
     * @param int    $attachmentID
     *
     * @return string
     */
    public static function makeResponsive(int $attachmentID): string
    {
        // Get the image
        $fullURL = wp_get_attachment_image_url($attachmentID, "full");

        // Get the sizes and srcset
        $imageSizes  = wp_get_attachment_image_sizes($attachmentID, "full");
        $imageSrcset = wp_get_attachment_image_srcset($attachmentID, "full");

        // Return the responsive image
        return wp_get_attachment_image(
            $attachmentID,
            "full",
            false,
            [
                "class"  => "toybox-responsive",
                "sizes"  => $imageSizes,
                "srcset" => $imageSrcset,
            ]
        );
    }

    /**
     * Adds the `srcset` and `sizes` attributes to an ACF image element.
     *
     * @param array $image The image array returned from ACF.
     *
     * @return string
     */
    public static function makeResponsiveFromACF(array $image): string
    {
        // Get the image
        $attachmentID = $image['ID'];

        return static::makeResponsive($attachmentID);
    }
}