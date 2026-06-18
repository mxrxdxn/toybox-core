# Customizer

The `Customizer` component registers and reads WordPress Customizer settings.

```php
use Toybox\Core\Components\Customizer;
```

## Methods

### `section()`

Adds a section to the WP Customizer.

```php
public static function section(string $id, string $title, int $priority = 30): void
```

| Parameter | Description |
| --- | --- |
| `$id` | The ID for the new section. |
| `$title` | The title for the new section. |
| `$priority` | The priority for the new section. |

**Returns:** void

### `setting()`

Adds a setting to a WP Customizer section.

```php
public static function setting(string $id, string $title, string $description, string $type, string|int|bool $default, string $sectionID, array $inputAttrs = [], string|\callable|false $sanitizeCallback = false, int $priority = 10): void
```

| Parameter | Description |
| --- | --- |
| `$id` | A specific ID of the setting. |
| `$title` | Label for the control. |
| `$description` | Description for the control. |
| `$type` | Control type. Core controls include 'text', 'checkbox', 'textarea', 'radio', 'select', and 'dropdown-pages'. Additional input types such as 'email', 'url', 'number', 'hidden', and 'date' are supported implicitly. Default 'text'. |
| `$default` | Default value for the setting. Default is empty string. |
| `$sectionID` | Section the control belongs to. |
| `$inputAttrs` | Attributes to pass into the input. |
| `$sanitizeCallback` | Callback to filter a Customize setting value in un-slashed form. |
| `$priority` | Order priority to load the control. Default 10. |

**Returns:** void

### `colorPicker()`

Registers a WordPress Customizer color setting and `WP_Customize_Color_Control`.

```php
public static function colorPicker(string $id, string $title, string $description, string|int|bool $default, string $sectionID, string|\callable|false $sanitizeCallback = false, int $priority = 10): void
```

| Parameter | Description |
| --- | --- |
| `$id` | Unique setting and control ID. |
| `$title` | Control label. |
| `$description` | Description displayed with the control. |
| `$default` | Default color value. |
| `$sectionID` | Customizer section that contains the control. |
| `$sanitizeCallback` | Optional callback used to sanitize the setting value. |
| `$priority` | Display priority for the control. |

### `boot()`

Registers the default Toybox color, heading, typography, and theme-color Customizer settings.

```php
public static function boot()
```

### `get()`

Return a value from the customizer.

```php
public static function get(string $key)
```

| Parameter | Description |
| --- | --- |
| `$key` | Theme modification key to retrieve. |

**Returns:** mixed

