# Content

The `Content` component modifies rendered WordPress content.

```php
use Toybox\Core\Components\Content;
```

## Methods

### `lazyLoad()`

Adds a filter to modify the content of posts by appending a "loading=lazy" attribute to <img> and <iframe> tags, which enables the lazy loading of these elements.

```php
public static function lazyLoad(): void
```

**Returns:** void

