# Globals

The `Globals` component retrieves site-wide settings from an Advanced Custom
Fields options page, with optional WordPress transient caching.

```php
use Toybox\Core\Components\Globals;
```

The component expects an ACF field named `global` stored against the `options`
post ID. The field should return an array.

## Retrieving settings

### `settings()`

Returns the global settings array.

```php
$settings = Globals::settings();

$companyName = $settings['company_name'] ?? '';
```

```php
public static function settings(bool $cached = true): array
```

| Parameter | Description |
| --- | --- |
| `$cached` | Use the cached settings when `true`, or read directly from ACF when `false`. |

By default, the settings are stored in a WordPress transient for one day. If
the transient does not exist, the component reads the settings from ACF and
populates the cache.

Pass `false` to bypass the transient:

```php
$settings = Globals::settings(cached: false);
```

The method returns an empty array when the ACF field has no value.

## Cache management

The transient key is available through the `SETTINGS_TRANSIENT` constant:

```php
Globals::SETTINGS_TRANSIENT;
// _toybox_global_settings
```

The cache can be cleared directly with the `Transient` component:

```php
use Toybox\Core\Components\Globals;
use Toybox\Core\Components\Transient;

Transient::delete(Globals::SETTINGS_TRANSIENT);
```

Alternatively, register the project's options-page cache invalidation hook:

```php
use Toybox\Core\Components\Misc;

Misc::clearSettingsCacheOnOptionsSave();
```

This clears the global, header, and footer settings transients when the ACF
options page with the menu slug `site-settings` is saved.

> Reading with `cached: false` bypasses the existing transient but does not
> update or delete it.
