# Cache

The `Cache` component enables full-page output caching.

```php
use Toybox\Core\Components\Cache;
```

## Methods

### `enable()`

Enables adding a Cache-Control header on page responses. This allows the user's browser to cache the response and save a visit to the server. It's probably best to keep the expiration low (10 mins or so) in case the page is altered in the backend.

```php
public static function enable(bool $visitorsOnly = true, int|Carbon $expiration = 600): void
```

| Parameter | Description |
| --- | --- |
| `$visitorsOnly` | Whether to only cache for visitors, or for all users. |
| `$expiration` | The expiration time, in seconds, or a Carbon timestamp of when to expire. |

**Returns:** void

