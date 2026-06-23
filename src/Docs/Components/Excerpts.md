# Excerpts

The `Excerpts` component configures and retrieves WordPress excerpts.

```php
use Toybox\Core\Components\Excerpts;
```

## Methods

### `length()`

Override the default excerpt length.

```php
public static function length(int $newLength): void
```

| Parameter | Description |
| --- | --- |
| `$newLength` | Number of words used for generated excerpts. |

**Returns:** void

### `ending()`

Override the default excerpt ending.

```php
public static function ending(string $ending): void
```

| Parameter | Description |
| --- | --- |
| `$ending` | Text appended to generated excerpts. |

**Returns:** void

### `get()`

Fetches a trimmed excerpt from either the excerpt field or from the post content if an exceprt hasn't been created.

```php
public static function get(\WP_Post|int|null $post = null): string
```

| Parameter | Description |
| --- | --- |
| `$post` | Post object or ID. When `null`, the global post is used. |

**Returns:** string

