# Scripts

The `Scripts` component modifies enqueued WordPress scripts.

```php
use Toybox\Core\Components\Scripts;
```

## Methods

### `defer()`

Adds a defer attribute to specified script tags in WordPress.

```php
public static function defer(array $handles): void
```

| Parameter | Description |
| --- | --- |
| `$handles` | An array of script handles that should have the defer attribute added. |

**Returns:** void

