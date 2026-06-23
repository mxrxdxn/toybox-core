# Lighthouse

The `Lighthouse` component detects requests made by Google Lighthouse.

```php
use Toybox\Core\Components\Google\Lighthouse;
```

## Methods

### `detected()`

Determines whether the "Lighthouse" string is present in the user agent.

```php
public static function detected(): bool
```

**Returns:** bool Returns true if "Lighthouse" is detected in the user agent, false otherwise.

