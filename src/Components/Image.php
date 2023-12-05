<?php

namespace Toybox\Core\Components;

class Image
{
    /**
     * Adds the `srcset` and `sizes` attributes to a pre-existing img element. Allows the image to be selected based on
     * screen real estate, so bandwidth can be saved.
     *
     * @param string $imgElement
     * @param array  $imageMeta
     * @param int    $attachmentID
     *
     * @return string
     */
    public static function makeResponsive(string $imgElement, array $imageMeta, int $attachmentID): string
    {
        return wp_image_add_srcset_and_sizes($imgElement, $imageMeta, $attachmentID);
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
        $imgElement = "<img src=\"{$image['url']}\" alt=\"{$image['alt']}\">";
        $imageMeta = wp_get_attachment_metadata($image['ID']);

        return static::makeResponsive($imgElement, $imageMeta, $image['ID']);
    }
}