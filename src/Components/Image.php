<?php

namespace Toybox\Core\Components;

use Toybox\Core\Exceptions\InvalidFormatException;
use Toybox\Core\Exceptions\InvalidQualityException;
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

    /**
     * Converts uploaded images to a specified format during the upload process.
     *
     * @param string   $format           The target image format for conversion. Defaults to "webp". Supported formats: "webp", "avif".
     * @param int|null $quality          The quality for the converted image. Must be between 0 and 100. Defaults to null (uses system defaults).
     * @param bool     $preserveOriginal Determines whether to preserve the original uploaded image file. Defaults to false.
     *
     * @return void
     *
     * @throws InvalidFormatException If the specified format is not allowed.
     * @throws InvalidQualityException If the specified quality is outside the range of 0-100.
     */
    public static function convertOnUpload(string $format = "webp", int|null $quality = null, bool $preserveOriginal = false): void
    {
        // The allowed formats.
        $allowedFormats = ["webp", "avif"];

        // Convert the method to lowercase.
        $format = strtolower($format);

        // Check to see if it's permitted or return if not.
        if (! in_array($format, $allowedFormats)) {
            throw new InvalidFormatException("The given format is not allowed. Allowed formats are: " . implode(", ", $allowedFormats) . ".");
        }

        // Check quality is within permitted bounds.
        if (is_int($quality) && ($quality < 0 || $quality > 100)) {
            throw new InvalidQualityException("The given quality is not within the permitted range. It must be between 0 and 100.");
        }

        add_filter('wp_handle_upload', function ($upload) use ($format, $quality, $preserveOriginal) {
            // Check if the uploaded file is an image.
            if (! isset($upload['type']) || strpos($upload['type'], 'image/') !== 0) {
                return $upload;
            }

            // Check if the image is already in the correct format.
            if ($upload['type'] === "image/{$format}") {
                return $upload;
            }

            $originalFile = $upload['file'];

            // Load the uploaded image into the WordPress image editor.
            $imageEditor = wp_get_image_editor($originalFile);
            if (is_wp_error($imageEditor)) {
                return $upload;
            }

            $newFile = dirname($originalFile) . '/' . wp_basename($originalFile, '.' . pathinfo($originalFile, PATHINFO_EXTENSION)) . '.' . $format;

            // Set the image quality.
            if ($quality !== null) {
                $imageEditor->set_quality($quality);
            }

            // Convert the image to the new format.
            $conversionResult = $imageEditor->save($newFile, "image/{$format}");

            if (is_wp_error($conversionResult)) {
                // Return the original file if the conversion fails.
                return $upload;
            }

            // If the original file is smaller, return the original file.
            if (filesize($newFile) > filesize($originalFile)) {
                return $upload;
            }

            // Update resized/cropped versions to the new format.
            $sizes = $imageEditor->multi_resize(wp_get_registered_image_subsizes());
            if ($sizes) {
                foreach ($sizes as $size) {
                    if (isset($size['file'])) {
                        $resizeFile   = dirname($originalFile) . '/' . $size['file'];
                        $resizeEditor = wp_get_image_editor($resizeFile);

                        if (! is_wp_error($resizeEditor)) {
                            if ($quality !== null) {
                                $resizeEditor->set_quality($quality);
                            }

                            $resizeEditor->save(str_replace(wp_basename($resizeFile), wp_basename($resizeFile, '.' . pathinfo($resizeFile, PATHINFO_EXTENSION)) . '.' . $format, $resizeFile), "image/{$format}");

                            // Clean up non-converted files immediately.
                            if ($preserveOriginal === false) {
                                @unlink($resizeFile);
                            }
                        }
                    }
                }
            }

            // Remove the original file to save disk space.
            if ($preserveOriginal === false) {
                @unlink($originalFile);
            }

            // Update the file path and MIME type in the upload array.
            $upload['file'] = $newFile;
            $upload['url']  = str_replace(wp_basename($originalFile), wp_basename($newFile), $upload['url']);
            $upload['type'] = "image/{$format}";

            return $upload;
        });
    }
}
