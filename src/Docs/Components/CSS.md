# CSS

The `CSS` component adds compiled CSS files as inline WordPress styles.

```php
use Toybox\Core\Components\CSS;
```

## Methods

### `inline()`

Inlines CSS styling for better page performance.

```php
public static function inline(string $handle, string $cssPath): void
```

| Parameter | Description |
| --- | --- |
| `$handle` | Handle of the enqueued stylesheet that receives the inline CSS. |
| `$cssPath` | Filesystem path to the CSS file. |

**Returns:** void

**Throws:**

- PathDoesNotExistException

