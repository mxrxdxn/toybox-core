<?php

namespace Toybox\Core\Components;

class ACF
{
    /**
     * Sets the API key used in the ACF backend when displaying maps within custom fields.
     *
     * @param string $key
     *
     * @return void
     */
    public static function setMapsApiKey(string $key): void
    {
        add_filter('acf/fields/google_map/api', function ($api) use ($key) {
            $api['key'] = $key;

            return $api;
        });
    }
}