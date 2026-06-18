# Assets

The `Assets` component loads Vite development and production assets in WordPress.

```php
use Toybox\Core\Components\Assets;
```

## Methods

### `devIsRunning()`

Checks whether the development server is running by making a request to a specific URL. This method verifies the availability of the Vite development server by sending an HTTP GET request to the server's URL. If the server responds with a valid response code, it is considered to be running.

```php
public static function devIsRunning(): ?bool
```

**Returns:** bool\|null Returns true if the development server is running, false otherwise.

### `manifest()`

Retrieves the Vite manifest file as an associative array. This function caches the manifest to avoid redundant file reads and parsing during subsequent calls.

```php
public static function manifest(): ?array
```

**Returns:** array\|null The decoded contents of the manifest file as an associative array. Returns an empty array if the file does not exist or cannot be decoded into a valid array.

### `entry()`

Generates a URL for the specified entry point by appending it to the Vite development server URL.

```php
public static function entry(string $entry): string
```

| Parameter | Description |
| --- | --- |
| `$entry` | The entry point path, typically a file path relative to the root. |

**Returns:** string The full URL for the entry point on the Vite development server.

### `enqueue()`

Enqueues a script or style asset for use in WordPress. This method handles both development and production environments by determining the appropriate file paths, prefixes, and asset registration logic. In development mode, assets are directly loaded, whereas in production, a manifest file is used to fetch the correct file references.

```php
public static function enqueue(string $entry, string $handle_prefix = 'theme'): void
```

| Parameter | Description |
| --- | --- |
| `$entry` | The name of the asset file (e.g., 'main.js', 'styles.scss'). |
| `$handle_prefix` | An optional string used as a prefix for the generated WordPress handle. Defaults to 'theme'. |

**Returns:** void

### `printClient()`

Outputs a script tag for the Vite development client. This method ensures the Vite client script is only printed once during execution, and only in development mode. It serves to load the Vite development server's client script, which is responsible for hot module replacement (HMR).

```php
public static function printClient(): void
```

**Returns:** void

### `getPath()`

Retrieves the relative file path for a Vite asset based on its entry name in the manifest. This method looks up the specified entry in the Vite manifest and returns the relative file path if found. Returns null if the entry does not exist in the manifest or if the manifest file cannot be loaded.

```php
public static function getPath(string $entry): ?string
```

| Parameter | Description |
| --- | --- |
| `$entry` | The name of the asset entry (e.g., 'main.js', 'styles.scss'). |

**Returns:** string\|null The relative file path of the asset, or null if not found.

