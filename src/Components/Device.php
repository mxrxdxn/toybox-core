<?php

namespace Toybox\Core\Components;

use Detection\MobileDetect;

class Device extends MobileDetect
{
    /**
     * Detect if the user is on a mobile device, with a fallback to MobileDetect if WP's built-in detection fails.
     *
     * @param $userAgent
     * @param $httpHeaders
     *
     * @return bool
     */
    public function isMobile($userAgent = null, $httpHeaders = null): bool
    {
        if (wp_is_mobile()) {
            return true;
        }

        return parent::isMobile($userAgent, $httpHeaders);
    }
}
