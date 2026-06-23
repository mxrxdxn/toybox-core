# jQuery

The `jQuery` component removes jQuery Migrate from public WordPress requests.

```php
use Toybox\Core\Components\jQuery;
```

## Methods

### `removeMigrate()`

Removes the dependency on jQuery Migrate for frontend scripts. This method hooks into the `wp_default_scripts` action and modifies the `jquery` script's dependencies to exclude `jquery-migrate`. The modification is applied only for frontend scripts and does not affect the admin area.

```php
public static function removeMigrate(): void
```

**Returns:** void

