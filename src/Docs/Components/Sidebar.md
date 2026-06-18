# Sidebar

The `Sidebar` component registers WordPress widget sidebars.

```php
use Toybox\Core\Components\Sidebar;
```

## Methods

### `register()`

Registers a widget sidebar during the WordPress `widgets_init` action.

```php
public static function register(array $args = []): void
```

| Parameter | Description |
| --- | --- |
| `$args` | Sidebar arguments intended to override the component defaults. |

**Returns:** void

