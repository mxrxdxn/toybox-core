# Reviews

The `Reviews` component stores and retrieves Google Places reviews through WordPress.

```php
use Toybox\Core\Components\Google\Reviews;
```

## Methods

### `boot()`

Boots the application by setting up the necessary database and initializing a cron job for fetching data.

```php
public static function boot(string $placeID, string $cronSchedule = "daily"): void
```

| Parameter | Description |
| --- | --- |
| `$placeID` | The Google Place ID for retrieving data associated with the specified location. |
| `$cronSchedule` | The schedule frequency for the cron job (default: 'daily'). |

**Returns:** void

### `getReviews()`

Retrieves a specified number of random Google reviews from the database. This method fetches reviews stored in the `maxweb_reviews` database table filtered by the review type "Google". The reviews are returned in random order, with the number of reviews limited by the specified count. The returned array includes details such as author name, image, review content, rating, and formatted creation date.

```php
public static function getReviews(int $count = 5): array
```

| Parameter | Description |
| --- | --- |
| `$count` | The number of reviews to retrieve (default is 5). |

**Returns:** array An array of associative arrays, each representing a review with keys: 'author', 'image', 'content', 'rating', and 'created_at'.

