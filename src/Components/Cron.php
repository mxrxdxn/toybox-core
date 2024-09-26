<?php

namespace Toybox\Core\Components;

class Cron
{
    /**
     * Add a custom cron schedule.
     *
     * @param string      $name          The display name for the schedule.
     * @param int         $timeInSeconds How long (in seconds) between runs of jobs for this schedule.
     * @param string|null $key           The key for the scheduler - auto-generated from the name if not supplied.
     *
     * @return void
     */
    public static function addSchedule(string $name, int $timeInSeconds, string $key = null): void
    {
        // Auto-generate the key if necessary
        if (empty($key)) {
            $key = slugify($key, "_");
        }

        // Add the schedule
        add_filter("cron_schedules", function ($schedules) use ($name, $timeInSeconds, $key) {
            $schedules[$key] = [
                "interval" => $timeInSeconds,
                "display"  => $name,
            ];

            return $schedules;
        });
    }
}
