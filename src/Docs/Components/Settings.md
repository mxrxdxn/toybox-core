# Settings

The `Settings` component registers ACF options pages.

```php
use Toybox\Core\Components\Settings;
```

## Methods

### `registerPage()`

Registers the theme's option pages using ACF. These pages can then be populated via ACF. If ACF is not installed, nothing will fire.

```php
public static function registerPage(array $options): void
```

| Parameter | Description |
| --- | --- |
| `$options` | Options passed to `acf_add_options_page()` or `acf_add_options_sub_page()`. |

**Returns:** void

