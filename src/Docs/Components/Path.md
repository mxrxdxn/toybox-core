# Path

The `Path` component returns filesystem paths for WordPress themes and plugins.

```php
use Toybox\Core\Components\Path;
```

## Methods

### `home()`

Shorthand function for `get_home_path()`. Gets the absolute filesystem path to the root of the WordPress installation.

```php
public static function home(): string
```

**Returns:** string Full filesystem path to the root of the WordPress installation.

### `stylesheetDirectory()`

Shorthand function for `get_stylesheet_directory()`. Retrieves stylesheet directory path for the active theme.

```php
public static function stylesheetDirectory(): string
```

**Returns:** string Path to active theme’s stylesheet directory.

### `templateDirectory()`

Shorthand function for `get_template_directory()`. Retrieves template directory path for the active theme.

```php
public static function templateDirectory(): string
```

**Returns:** string Path to active theme’s template directory.

### `themeFile()`

Shorthand function for `get_theme_file_path()`. Retrieves the path of a file in the theme. Searches in the stylesheet directory before the template directory so themes which inherit from a parent theme can just override one file.

```php
public static function themeFile(string $file = ''): string
```

| Parameter | Description |
| --- | --- |
| `$file` | File to search for in the stylesheet directory. |

**Returns:** string The path of the file.

### `pluginDirectory()`

Shorthand function for `plugin_dir_path()`. Get the filesystem directory path (with trailing slash) for the plugin __FILE__ passed in.

```php
public static function pluginDirectory(string $file): string
```

| Parameter | Description |
| --- | --- |
| `$file` | The filename of the plugin (__FILE__). |

**Returns:** string The filesystem path of the directory that contains the plugin.

