# WordPress

The `WordPress` component loads WordPress from a standalone PHP process.

```php
use Toybox\Core\Components\WordPress;
```

## Methods

### `connect()`

Connect the command line to WordPress when required.

```php
public static function connect(string|null $domain = null): void
```

| Parameter | Description |
| --- | --- |
| `$domain` | Optional domain used to initialize the WordPress request environment. |

**Returns:** void

**Throws:**

- CannotConnectToWordPressException

