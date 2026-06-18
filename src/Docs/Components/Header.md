# Header

The `Header` component cleans WordPress head output and retrieves cached header settings.

```php
use Toybox\Core\Components\Header;
```

## Constants

### `SETTINGS_TRANSIENT`

Transient key used for storing header settings in the cache.

```php
public const string SETTINGS_TRANSIENT = "_toybox_header_settings";
```

## Methods

### `cleanup()`

Cleans up unnecessary meta elements from the WordPress head section upon initialization.

```php
public static function cleanup(): void
```

**Returns:** void

### `settings()`

Fetch the header settings.

```php
public static function settings(bool $cached = true): array
```

| Parameter | Description |
| --- | --- |
| `$cached` | Use a cached version of the settings for performance benefits. |

**Returns:** array

### `code()`

Fetch the header include code.

```php
public static function code(bool $cached = true): string
```

| Parameter | Description |
| --- | --- |
| `$cached` | Use a cached version of the code for performance benefits. |

**Returns:** string

