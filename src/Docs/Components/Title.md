# Title

The `Title` component overrides the WordPress document title.

```php
use Toybox\Core\Components\Title;
```

## Methods

### `override()`

Override the page title.

```php
public static function override(string $newTitle, bool $appendSiteName = true): void
```

| Parameter | Description |
| --- | --- |
| `$newTitle` | Replacement document title. |
| `$appendSiteName` | Append the site name to the replacement title when `true`. |

**Returns:** void

