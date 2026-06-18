# HTTP

The `HTTP` component provides WordPress component utilities.

```php
use Toybox\Core\Components\HTTP;
```

## Methods

### `hint()`

Send 103 early hints for assets, allowing the browser to connect and start retrieving assets before they are requested in code.

```php
public static function hint(string $asset, string $hints = ""): void
```

| Parameter | Description |
| --- | --- |
| `$asset` | The path of the asset to push. |
| `$hints` | The resource hints for the asset. |

**Returns:** void

### `preload()`

Adds preloading for scripts and styles using native functionality.

```php
public static function preload(): void
```

**Returns:** void

