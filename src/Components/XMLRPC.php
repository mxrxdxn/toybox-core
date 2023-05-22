<?php

namespace Toybox\Core\Components;

class XMLRPC
{
    /**
     * Disable XMLRPC.
     *
     * @return void
     */
    public static function disable(): void
    {
        add_filter('xmlrpc_enabled', '__return_false');
    }
}