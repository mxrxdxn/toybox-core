# Email

The `Email` component obfuscates email addresses for safer frontend output.

```php
use Toybox\Core\Components\Email;
```

## Methods

### `mask()`

Shorthand function for `antispambot()`. Converts email addresses characters to HTML entities to block spam bots.

```php
public static function mask(string $email, int $hexEncoding): string
```

| Parameter | Description |
| --- | --- |
| `$email` | Email address. |
| `$hexEncoding` | Set to 1 to enable hex encoding. |

**Returns:** string

