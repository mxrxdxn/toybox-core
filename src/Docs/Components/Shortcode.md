# Shortcode

The `Shortcode` component registers shortcodes and normalizes shortcode attributes.

```php
use Toybox\Core\Components\Shortcode;
```

## Methods

### `boot()`

Autoload shortcodes from the /shortcodes directory.

```php
public static function boot(): void
```

**Returns:** void

### `add()`

Shorthand function for `add_shortcode()`. Care should be taken through prefixing or other means to ensure that the shortcode tag being added is unique and will not conflict with other, already-added shortcode tags. In the event of a duplicated tag, the tag loaded last will take precedence.

```php
public static function add(string $code, \Closure $callable): void
```

| Parameter | Description |
| --- | --- |
| `$code` | Shortcode tag to be searched in post content. |
| `$callable` | The callback function to run when the shortcode is found. Every shortcode callback is passed three parameters by default, including an array of attributes ($atts), the shortcode content or null if not set ($content), and finally the shortcode tag itself ($shortcode_tag), in that order. |

**Returns:** void

### `attributes()`

Shorthand function for `shortcode_atts()`. Combines user attributes with known attributes and fill in defaults when needed. The pairs should be considered to be all the attributes which are supported by the caller and given as a list. The returned attributes will only contain the attributes in the $pairs list. If the $attributes list has unsupported attributes, then they will be ignored and removed from the final returned list.

```php
public static function attributes(array $defaults, array $attributes, string $shortcode = ""): array
```

| Parameter | Description |
| --- | --- |
| `$defaults` | Entire list of supported attributes and their defaults. |
| `$attributes` | User defined attributes in shortcode tag. |
| `$shortcode` | The name of the shortcode, provided for context to enable filtering. |

**Returns:** array

