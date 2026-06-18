# ACF

The `ACF` component configures Advanced Custom Fields integrations, JSON storage paths, and shortcode handling.

```php
use Toybox\Core\Components\ACF;
```

## Methods

### `setMapsApiKey()`

Sets the API key used in the ACF backend when displaying maps within custom fields.

```php
public static function setMapsApiKey(string|null $key = null): void
```

| Parameter | Description |
| --- | --- |
| `$key` | Google Maps API key. When `null`, the `google_maps_api_key` ACF option is used. |

**Returns:** void

### `loadBlockACFFields()`

Loads ACF fields from block directories.

```php
public static function loadBlockACFFields(): void
```

**Returns:** void

### `saveBlockACFFields()`

Adjusts the save location for ACF JSON files based on the context of the field group. If the field group corresponds to a block, the JSON is saved within the block's directory. Otherwise, it is saved to the default theme-level ACF JSON directory.

```php
public static function saveBlockACFFields(): void
```

**Returns:** void

### `setSavePoint()`

Sets the save point for a block.

```php
public static function setSavePoint(string $blockName = ""): void
```

| Parameter | Description |
| --- | --- |
| `$blockName` | DEPRECATED - The name of the block. |

**Returns:** void

### `setPostTypeSavePath()`

Set the save path for ACF post types.

```php
public static function setPostTypeSavePath(): void
```

**Returns:** void

### `setPostTypeLoadPath()`

Set the load path for ACF post types.

```php
public static function setPostTypeLoadPath(): void
```

**Returns:** void

### `setTaxonomySavePath()`

Set the save path for ACF taxonomies.

```php
public static function setTaxonomySavePath(): void
```

**Returns:** void

### `setTaxonomyLoadPath()`

Set the load path for ACF setting pages.

```php
public static function setTaxonomyLoadPath(): void
```

**Returns:** void

### `setOptionsPageSavePath()`

Set the save path for ACF setting pages.

```php
public static function setOptionsPageSavePath(): void
```

**Returns:** void

### `setOptionsPageLoadPath()`

Set the load path for ACF setting pages.

```php
public static function setOptionsPageLoadPath(): void
```

**Returns:** void

### `setPaths()`

Shorthand function to register all paths.

```php
public static function setPaths(): void
```

**Returns:** void

### `enableShortcode()`

Enable the ACF shortcode.

```php
public static function enableShortcode(): void
```

**Returns:** void

### `doShortcodes()`

Process shortcodes for specified field types.

```php
public static function doShortcodes(array $args = [])
```

| Parameter | Description |
| --- | --- |
| `$args` | The field types for which shortcodes should be processed. |

**Returns:** void

