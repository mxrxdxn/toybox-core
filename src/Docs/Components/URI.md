# URI

The `URI` component builds WordPress theme, plugin, home, site, and admin URLs.

```php
use Toybox\Core\Components\URI;
```

## Methods

### `home()`

Shorthand function for `home_url()`. Retrieves the URL for the current site where the front end is accessible. Returns the ‘home’ option with the appropriate protocol. The protocol will be ‘https’ if is_ssl() evaluates to true; otherwise, it will be the same as the ‘home’ option. If $scheme is ‘http’ or ‘https’, is_ssl() is overridden.

```php
public static function home(string $path = '', string|null $scheme = null): string
```

| Parameter | Description |
| --- | --- |
| `$path` | Path relative to the home URL. |
| `$scheme` | Scheme to give the home URL context. Accepts 'http', 'https', 'relative', 'rest', or null. |

**Returns:** string Home URL link with optional path appended.

### `admin()`

Shorthand function for `admin_url()`. Retrieves the URL to the admin area for the current site.

```php
public static function admin(string $path = '', string $scheme = 'admin'): string
```

| Parameter | Description |
| --- | --- |
| `$path` | Path relative to the admin URL. |
| `$scheme` | The scheme to use. Default is 'admin', which obeys force_ssl_admin() and is_ssl(). 'http' or 'https' can be passed to force those schemes. |

**Returns:** string Admin URL link with optional path appended.

### `site()`

Shorthand function for `get_site_url()`. Retrieves the URL for a given site where WordPress application files (e.g. wp-blog-header.php or the wp-admin/ folder) are accessible. Returns the ‘site_url’ option with the appropriate protocol, ‘https’ if is_ssl() and ‘http’ otherwise. If $scheme is ‘http’ or ‘https’, is_ssl() is overridden.

```php
public static function site(int|null $blog_id = null, string $path = '', string|null $scheme = null): string
```

| Parameter | Description |
| --- | --- |
| `$blog_id` | Site ID. Default null (current site). |
| `$path` | Path relative to the site URL. |
| `$scheme` | Scheme to give the site URL context. Accepts 'http', 'https', 'login', 'login_post', 'admin', or 'relative'. |

**Returns:** string Site URL link with optional path appended.

### `stylesheetDirectory()`

Shorthand function for `get_stylesheet_directory_uri()`. Retrieves stylesheet directory URI for the active theme.

```php
public static function stylesheetDirectory(): string
```

**Returns:** string URI to active theme’s stylesheet directory.

### `templateDirectory()`

Shorthand function for `get_template_directory_uri()`. Retrieves template directory URI for the active theme.

```php
public static function templateDirectory(): string
```

**Returns:** string URI to active theme’s template directory.

### `themeFile()`

Shorthand function for `get_theme_file_uri()`. Retrieves the URL of a file in the theme. Searches in the stylesheet directory before the template directory so themes which inherit from a parent theme can just override one file.

```php
public static function themeFile(string $file = ""): string
```

| Parameter | Description |
| --- | --- |
| `$file` | File to search for in the stylesheet directory. |

**Returns:** string The URL of the file.

### `pluginDirectory()`

Shorthand function for `plugin_dir_url()`. Get the URL directory path (with trailing slash) for the plugin __FILE__ passed in.

```php
public static function pluginDirectory(string $file): string
```

| Parameter | Description |
| --- | --- |
| `$file` | The filename of the plugin (__FILE__). |

**Returns:** string The URL path of the directory that contains the plugin.

