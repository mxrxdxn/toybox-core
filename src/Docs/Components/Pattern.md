# Pattern

The `Pattern` component registers block pattern categories and removes default patterns.

```php
use Toybox\Core\Components\Pattern;
```

## Methods

### `registerCategory()`

Register a new pattern category.

```php
public static function registerCategory(string $name, string $slug, array $properties = [])
```

| Parameter | Description |
| --- | --- |
| `$name` | The name of the category. |
| `$slug` | Unique block pattern category slug. |
| `$properties` | Optional properties passed to `register_block_pattern_category()`. |

**Returns:** void

### `deregisterDefaultPatterns()`

Removes support for the default WordPress core block patterns during initialization.

```php
public static function deregisterDefaultPatterns()
```

