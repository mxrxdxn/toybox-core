# Pingbacks

The `Pingbacks` component prevents self-pingbacks in WordPress.

```php
use Toybox\Core\Components\Pingbacks;
```

## Methods

### `disableSelfPingbacks()`

Prevents self-pingbacks by removing links to the site's own URL during the pre-ping process. This method hooks into the "pre_ping" action, iterating through the list of pingback links and removing any links that point to the site's own home URL.

```php
public static function disableSelfPingbacks(): void
```

**Returns:** void

