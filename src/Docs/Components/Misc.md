# Misc

The `Misc` component provides miscellaneous WordPress configuration helpers.

```php
use Toybox\Core\Components\Misc;
```

## Methods

### `disableCapitalPDangit()`

WordPress, being WordPress, obviously has a filter to replace all instances of "Wordpress" with "WordPress". It's totally unnecessary, and just means we're wasting resources, so we'll go ahead and de-register the filter.

```php
public static function disableCapitalPDangit(): void
```

**Returns:** void

### `hideVersion()`

Hide the WordPress version number.

```php
public static function hideVersion(): void
```

**Returns:** void

### `addFileSupport()`

Adds support for additional file types in WordPress' media upload.

```php
public static function addFileSupport(array $mimeTypes): void
```

| Parameter | Description |
| --- | --- |
| `$mimeTypes` | Map of file extensions to MIME types allowed by WordPress uploads. |

**Returns:** void

### `optimizeTables()`

Optimize tables after switching themes.

```php
public static function optimizeTables(): void
```

**Returns:** void

### `setImageSizes()`

Set custom image sizes for media uploader.

```php
public static function setImageSizes(array $sizes): void
```

| Parameter | Description |
| --- | --- |
| `$sizes` | Map of image-size names to `name`, `width`, `height`, and `crop` options. |

**Returns:** void

### `clearSettingsCacheOnOptionsSave()`

Clears cached header settings when an ACF options page is saved.

```php
public static function clearSettingsCacheOnOptionsSave(): void
```

**Returns:** void

