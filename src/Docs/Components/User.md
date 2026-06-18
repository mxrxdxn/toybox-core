# User

The `User` component queries the current or selected WordPress user.

```php
use Toybox\Core\Components\User;
```

## Methods

### `loggedIn()`

Check if we're currently logged in as a user.

```php
public static function loggedIn(): bool
```

**Returns:** bool

### `for()`

Change the current user context to another user.

```php
public static function for(WP_User $user): static
```

| Parameter | Description |
| --- | --- |
| `$user` | WordPress user to use for subsequent component calls. |

**Returns:** static

### `can()`

Check if the user can perform a given capability.

```php
public static function can($capability): bool
```

| Parameter | Description |
| --- | --- |
| `$capability` | WordPress capability to check. |

**Returns:** bool

