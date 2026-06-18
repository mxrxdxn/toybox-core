# Transient

The `Transient` component reads, writes, deletes, and remembers WordPress transient values.

```php
use Toybox\Core\Components\Transient;
```

## Methods

### `set()`

Sets a transient - this allows data to be cached easily within WordPress.

```php
public static function set(string $name, mixed $contents, int|Carbon $expiration): bool
```

| Parameter | Description |
| --- | --- |
| `$name` | The name of the transient. |
| `$contents` | The data to store. |
| `$expiration` | The expiration time. If an integer is passed, it's the time in seconds. If a Carbon timestamp is passed, expiry will happen at that time. |

**Returns:** bool

### `get()`

Gets a transient from the cache.

```php
public static function get(string $name): mixed
```

| Parameter | Description |
| --- | --- |
| `$name` | The name of the transient. |

**Returns:** mixed

### `delete()`

Delete a transient.

```php
public static function delete(string $name): bool
```

| Parameter | Description |
| --- | --- |
| `$name` | The name of the transient. |

**Returns:** bool

### `remember()`

Retrieves a value from the cache or computes and stores it if not already cached.

```php
public static function remember(string $name, Closure $callback, int|Carbon $expiration): mixed
```

| Parameter | Description |
| --- | --- |
| `$name` | The key under which the value is stored. |
| `$callback` | The callback to compute and return the value if not already cached. |
| `$expiration` | The expiration time for the cached value. |

**Returns:** mixed The cached or computed value.

