# Menus

The `Menus` component registers and renders WordPress navigation menus.

```php
use Toybox\Core\Components\Menus;
```

## Methods

### `set()`

Registers menu locations and names in WordPress. Uses the same syntax as the native `register_nav_menus` function: ``` [ 'menu_location' => __("Menu Name", "text-domain") ] ``` Text domain isn't required - in fact, you can completely omit the __() call and just pass in a string if you want.

```php
public static function set(array $menus = []): void
```

| Parameter | Description |
| --- | --- |
| `$menus` | Map of menu location slugs to display names, using `register_nav_menus()` syntax. |

**Returns:** void

### `get()`

Returns or prints a menu.

```php
public static function get(string $location, array $params = [], bool $return = true): string|bool
```

| Parameter | Description |
| --- | --- |
| `$location` | The value for `theme_location`. |
| `$params` | The parameters to override. Note that `theme_location` and `return` cannot be overridden. |
| `$return` | Return the menu as a string, or print it. |

**Returns:** string\|bool

