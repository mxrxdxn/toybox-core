# Login

The `Login` component customizes the WordPress login screen and login errors.

```php
use Toybox\Core\Components\Login;
```

## Methods

### `boot()`

Sets the logo on the login page.

```php
public static function boot()
```

**Returns:** void

### `maskErrors()`

Hide the login error messages as they can be abused by hackers to retrieve a list of valid users/emails.

```php
public static function maskErrors(): void
```

**Returns:** void

### `isLoginPage()`

Return whether we're on the login page.

```php
public static function isLoginPage(): bool
```

**Returns:** bool

