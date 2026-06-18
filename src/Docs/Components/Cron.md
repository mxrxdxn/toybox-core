# Cron

The `Cron` component registers custom WordPress cron schedules.

```php
use Toybox\Core\Components\Cron;
```

## Methods

### `addSchedule()`

Add a custom cron schedule.

```php
public static function addSchedule(string $name, int $timeInSeconds, string|false $key = false): void
```

| Parameter | Description |
| --- | --- |
| `$name` | The display name for the schedule. |
| `$timeInSeconds` | How long (in seconds) between runs of jobs for this schedule. |
| `$key` | The key for the scheduler - auto-generated from the name if not supplied. |

**Returns:** void

