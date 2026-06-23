# Device

The `Device` component provides device detection based on Mobile Detect.

```php
use Toybox\Core\Components\Device;
```

## Methods

### `isMobile()`

Detect if the user is on a mobile device, with a fallback to MobileDetect if WP's built-in detection fails.

```php
public function isMobile($userAgent = null, $httpHeaders = null): bool
```

| Parameter | Description |
| --- | --- |
| `$userAgent` | Optional user-agent string passed to Mobile Detect. |
| `$httpHeaders` | Optional HTTP headers passed to Mobile Detect. |

**Returns:** bool

