# Post

The `Post` component retrieves, measures, and renders WordPress posts.

```php
use Toybox\Core\Components\Post;
```

## Methods

### `get()`

Fetches a post by its ID.

```php
public static function get(int $postID): WP_Post
```

| Parameter | Description |
| --- | --- |
| `$postID` | WordPress post ID to retrieve. |

**Returns:** WP_Post

### `calculateReadingSpeed()`

Calculates how long it takes to read an article, rounded up to the next minute.

```php
public static function calculateReadingSpeed(\WP_Post|int|null $post = null, float $wordsPerMinute = 238): float
```

| Parameter | Description |
| --- | --- |
| `$post` | The post's ID. |
| `$wordsPerMinute` | The words per minute score to use in the calculation. For reference, the average in the Maxweb office is ~343.1. |

**Returns:** float

### `render()`

Renders a post into a string that can then be used inside a template file.

```php
public static function render(int|\WP_Post $post): string
```

| Parameter | Description |
| --- | --- |
| `$post` | Post object or ID whose block content should be rendered. |

**Returns:** string

