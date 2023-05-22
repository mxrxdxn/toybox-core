<?php

namespace Toybox\Core\Components;

class HTTP
{
    /**
     * Send 103 early hints for assets, allowing the browser to connect and start retrieving assets before they are
     * requested in code.
     *
     * @param string $asset The path of the asset to push.
     * @param string $hints The resource hints for the asset.
     *
     * @return void
     */
    public static function hint(string $asset, string $hints = ""): void
    {
        add_action("send_headers", function () use ($asset, $hints) {
            header("Link: <{$asset}>; {$hints}", false);
        });
    }
}