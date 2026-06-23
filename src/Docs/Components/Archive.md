# Archive

The `Archive` component customizes archive-page metadata.

```php
use Toybox\Core\Components\Archive;
```

## Methods

### `setMetaTitle()`

Allows archive pages to have their title overridden.

```php
public static function setMetaTitle(string $postTypeName, string $newTitle, bool $appendSiteName = true): void
```

| Parameter | Description |
| --- | --- |
| `$postTypeName` | The name of the post type. |
| `$newTitle` | The new title for the page. |
| `$appendSiteName` | Whether to append the site name to the page title. Defaults to true, matching standard WordPress behaviour. |

**Returns:** void

