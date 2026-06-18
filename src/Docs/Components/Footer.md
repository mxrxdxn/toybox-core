# Footer

The `Footer` component retrieves cached footer settings and code from ACF options.

```php
use Toybox\Core\Components\Footer;
```

## Constants

### `SETTINGS_TRANSIENT`

Transient key used for storing footer settings in the cache.

```php
public const string SETTINGS_TRANSIENT = "_toybox_footer_settings";
```

## Methods

### `settings()`

Fetch the footer settings.

```php
public static function settings(bool $cached = true): array
```

| Parameter | Description |
| --- | --- |
| `$cached` | Use a cached version of the settings for performance benefits. |

**Returns:** array

### `code()`

Fetch the footer include code.

```php
public static function code(bool $cached = true): string
```

| Parameter | Description |
| --- | --- |
| `$cached` | Use a cached version of the code for performance benefits. |

**Returns:** string

