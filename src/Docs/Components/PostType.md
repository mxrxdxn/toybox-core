# PostType

The `PostType` component registers Toybox post types and resolves post type names.

```php
use Toybox\Core\Components\PostType;
```

## Methods

### `boot()`

Autoload custom post types from the /post-types directory.

```php
public static function boot(): void
```

**Returns:** void

### `get()`

Shorthand function for `get_post_type()`. Retrieves the post type of the current post or of a given post.

```php
public static function get(int|WP_Post|null $post = null): string|false
```

| Parameter | Description |
| --- | --- |
| `$post` | Post ID or post object. Default is global $post. |

**Returns:** string\|false Post type on success, false on failure.

