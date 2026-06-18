# Styles

The `Styles` component configures Toybox theme styles and critical CSS.

```php
use Toybox\Core\Components\Styles;
```

## Methods

### `boot()`

Enqueues any styles or scripts required by the theme.

```php
public static function boot(bool $disableCritical = false): void
```

| Parameter | Description |
| --- | --- |
| `$disableCritical` | If set to true, the critical style will not be enqueued. |

**Returns:** void

**Throws:**

- Exception

