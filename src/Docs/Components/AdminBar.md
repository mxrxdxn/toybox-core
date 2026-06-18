# AdminBar

The `AdminBar` component customizes or disables the WordPress admin toolbar.

```php
use Toybox\Core\Components\AdminBar;
```

## Methods

### `disable()`

Disables the WordPress admin bar from being rendered.

```php
public static function disable(): void
```

**Returns:** void

### `setLogo()`

Sets the logo in the admin bar.

```php
public static function setLogo()
```

**Returns:** void

### `setLogoInAdminBar()`

Prints the CSS that replaces the WordPress admin-bar logo with `images/admin-logo.svg` from the active stylesheet directory.

```php
public static function setLogoInAdminBar(): void
```

### `replaceHowdy()`

Replace the "Howdy" message in the WP admin area with a time-specific message.

```php
public static function replaceHowdy(): void
```

**Returns:** void

### `addDocumentationLink()`

Adds a Dev Guide link to the admin bar for users who can manage options.

```php
public static function addDocumentationLink(): void
```

