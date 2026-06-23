# Frontend

The `Frontend` component disables public frontend access with an error response or redirect.

```php
use Toybox\Core\Components\Frontend;
```

## Methods

### `disable()`

Disables the frontend of a website with a message and an optional redirect.

```php
public static function disable(string $message, int $maintenanceCode = 503, string|false $redirect = false, int $redirectCode = 302): void
```

| Parameter | Description |
| --- | --- |
| `$message` | The message to display to the user. |
| `$maintenanceCode` | The code to use for maintenance page, defaults to 503. |
| `$redirect` | The URL to redirect to, or blank. |
| `$redirectCode` | Use either 301 (permanent) or 302 (temporary) redirect code. |

**Returns:** void

