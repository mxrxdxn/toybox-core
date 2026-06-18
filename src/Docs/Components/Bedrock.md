# Bedrock

The `Bedrock` component detects whether WordPress is running in a Bedrock project.

```php
use Toybox\Core\Components\Bedrock;
```

## Methods

### `detected()`

On Bedrock installations, the path to wp-load.php is different - this function figures out if we're on a Bedrock installation.

```php
public static function detected(): bool
```

**Returns:** bool

