# Admin

The `Admin` component configures the WordPress administration area and Toybox developer page.

```php
use Toybox\Core\Components\Admin;
```

## Methods

### `boot()`

Boots the admin styles.

```php
public static function boot(): void
```

**Returns:** void

### `registerDeveloperPage()`

Registers the Toybox developer admin page.

```php
public static function registerDeveloperPage(): void
```

**Returns:** void

### `renderDeveloperPage()`

Renders the Toybox developer admin page.

```php
public static function renderDeveloperPage(): void
```

**Returns:** void

### `hideWelcomePanel()`

Hide the welcome panel from displaying.

```php
public static function hideWelcomePanel(): void
```

**Returns:** void

### `disableUpdateNag()`

Stop non-admin users from seeing WordPress update notifications.

```php
public static function disableUpdateNag(): void
```

**Returns:** void

### `setFooterText()`

Sets the footer text.

```php
public static function setFooterText()
```

**Returns:** void

### `isAdminRequest()`

Detects whether the current request is an admin request.

```php
public static function isAdminRequest(): bool
```

**Returns:** bool

