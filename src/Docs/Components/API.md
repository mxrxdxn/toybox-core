# API

The `API` component registers custom endpoints with the WordPress REST API.

```php
use Toybox\Core\Components\API;
```

## Methods

### `addEndpoint()`

Adds an endpoint to the WP-JSON API. When you define your callback, make sure you pass in the argument for $request, which should be of type WP_REST_Request.

```php
public static function addEndpoint(string $endpoint, Closure $callback, Closure $permissionCallback, string $namespace = "toybox/v1", string $method = "GET"): void
```

| Parameter | Description |
| --- | --- |
| `$endpoint` | REST route path to register. |
| `$callback` | Callback that handles the REST request. |
| `$permissionCallback` | Callback used to determine whether the request is permitted. |
| `$namespace` | REST namespace. Defaults to `toybox/v1`. |
| `$method` | HTTP method used by the endpoint. |

**Returns:** void

**Throws:**

- InvalidMethodException

