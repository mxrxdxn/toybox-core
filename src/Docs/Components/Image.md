# Image

The `Image` component provides helpers for rendering responsive WordPress
attachment images and converting uploaded images to WebP or AVIF.

```php
use Toybox\Core\Components\Image;
```

## Responsive images

### `makeResponsive()`

Creates an image element from a WordPress attachment ID.

```php
Image::makeResponsive(
    attachmentID: 123,
    classes: ['article-image', 'alignwide'],
    size: 'large',
    attributes: [
        'alt' => 'A descriptive alternative text',
        'loading' => 'lazy',
    ],
);
```

```php
public static function makeResponsive(
    int $attachmentID,
    array $classes = ['toybox-responsive'],
    string $size = 'full',
    array $attributes = [],
): string
```

| Parameter | Description |
| --- | --- |
| `$attachmentID` | The WordPress attachment ID. |
| `$classes` | CSS classes added to the image element. |
| `$size` | The registered WordPress image size used for the image source. |
| `$attributes` | Additional attributes passed to `wp_get_attachment_image()`. |

The generated `sizes` and `srcset` attributes always use the attachment's
`full` image metadata, while `$size` controls the source image returned by
`wp_get_attachment_image()`.

The method returns the generated `<img>` element as a string. WordPress may
return an empty string when the attachment cannot be resolved.

### `makeResponsiveFromACF()`

Creates a responsive image from an Advanced Custom Fields image value configured
to return an image array.

```php
$image = get_field('hero_image');

echo Image::makeResponsiveFromACF(
    image: $image,
    classes: ['hero-image'],
    size: 'large',
    attributes: ['fetchpriority' => 'high'],
);
```

```php
public static function makeResponsiveFromACF(
    array|false $image,
    array $classes = ['toybox-responsive'],
    string $size = 'full',
    array $attributes = [],
): string
```

The image array must contain an `ID` key. If ACF returns `false`, the method
returns an empty string. All other arguments are passed to `makeResponsive()`.

### `makeResponsiveFromThumbnail()`

Creates a responsive image from a post's featured image.

```php
echo Image::makeResponsiveFromThumbnail(
    post: get_the_ID(),
    classes: ['post-thumbnail'],
    size: 'medium_large',
    attributes: ['loading' => 'lazy'],
);
```

```php
public static function makeResponsiveFromThumbnail(
    WP_Post|int|null $post,
    array $classes = ['toybox-responsive'],
    string $size = 'full',
    array $attributes = [],
): string
```

`$post` may be a `WP_Post` object, a post ID, or `null` to use the current post.
The method returns an empty string when the post has no featured image. All
other arguments are passed to `makeResponsive()`.

## Upload conversion

### `convertOnUpload()`

Registers a `wp_handle_upload` filter that converts subsequently uploaded images
to WebP or AVIF.

Call this method while bootstrapping the theme or plugin, before WordPress
handles an upload:

```php
use Toybox\Core\Components\Image;

Image::convertOnUpload(
    format: 'webp',
    quality: 80,
    preserveOriginal: false,
);
```

```php
public static function convertOnUpload(
    string $format = 'webp',
    ?int $quality = null,
    bool $preserveOriginal = false,
): void
```

| Parameter | Description |
| --- | --- |
| `$format` | Target format. Supported values are `webp` and `avif`; matching is case-insensitive. |
| `$quality` | Conversion quality from `0` to `100`, or `null` to use the image editor's default. |
| `$preserveOriginal` | Keep the original uploaded file and non-converted resized files when `true`. |

The upload is left unchanged when:

- The uploaded file is not an image.
- The image already uses the requested format.
- WordPress cannot load or save the image with its configured image editor.
- The converted full-size image is larger than the original.

When conversion succeeds, the upload's file path, URL, and MIME type are
updated to reference the converted image. The component also attempts to
generate registered image sub-sizes in the requested format.

> The active WordPress image editor, such as GD or Imagick, must support the
> requested output format. Use `wp_image_editor_supports()` if support needs to
> be checked before registering the conversion.

#### Exceptions

`convertOnUpload()` throws:

- `Toybox\Core\Exceptions\InvalidFormatException` when `$format` is not `webp`
  or `avif`.
- `Toybox\Core\Exceptions\InvalidQualityException` when `$quality` is outside
  the inclusive range `0` to `100`.
