# Author

The `Author` component customizes WordPress author URLs.

```php
use Toybox\Core\Components\Author;
```

## Methods

### `removeFrontUrl()`

Removes the permalink "front" segment (e.g., '/articles/') from author URLs, ensuring that author URLs do not include the "front" part of the permalink structure while leaving posts under the front unaffected. This adjustment is applied to both rewrite rules and author link output.

```php
public static function removeFrontUrl(): void
```

**Returns:** void

