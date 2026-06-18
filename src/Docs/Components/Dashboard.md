# Dashboard

The `Dashboard` component adds and removes WordPress dashboard widgets.

```php
use Toybox\Core\Components\Dashboard;
```

## Methods

### `addWidget()`

Render a widget in the Dashboard area of WordPress's admin area.

```php
public static function addWidget(string $widgetID, string $widgetTitle, string $widgetHTML)
```

| Parameter | Description |
| --- | --- |
| `$widgetID` | A unique ID for the widget. |
| `$widgetTitle` | The title of the widget. |
| `$widgetHTML` | The HTML content for the widget. |

**Returns:** void

### `hideWidgets()`

Hides specific widgets from the WordPress dashboard. This method removes certain default widgets such as Quick Draft, WordPress Events and News, and Activity from being displayed on the WordPress admin dashboard to streamline the interface for users.

```php
public static function hideWidgets()
```

**Returns:** void

