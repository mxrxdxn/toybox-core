# Term

The `Term` component queries taxonomy terms and their hierarchy.

```php
use Toybox\Core\Components\Term;
```

## Methods

### `level()`

Find the "level" of a term in a hierarchical taxonomy.

```php
public static function level(WP_Term $term): int
```

| Parameter | Description |
| --- | --- |
| `$term` | Term whose hierarchy depth should be calculated. |

**Returns:** int

### `in()`

Figure out if a term is "inside" (or a child of) another term in a hierarchical taxonomy.

```php
public static function in(WP_Term $term, WP_Term|int $in): bool
```

| Parameter | Description |
| --- | --- |
| `$term` | Term whose ancestry should be checked. |
| `$in` | Potential ancestor term or term ID. |

**Returns:** bool

### `for()`

Retrieves a list of all terms attached to a given post for a given taxonomy.

```php
public static function for(int|\WP_Post|null $post = null, string|array|null $taxonomy = null): array
```

| Parameter | Description |
| --- | --- |
| `$post` | Post object or ID. When `null`, the current post ID is used. |
| `$taxonomy` | Taxonomy name, list of taxonomy names, or `null` to inspect all taxonomies. |

**Returns:** array

