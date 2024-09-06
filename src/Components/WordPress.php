<?php

namespace Toybox\Core\Components;

use Toybox\Core\Exceptions\CannotConnectToWordPressException;
use Toybox\Core\Theme;
use const Toybox\Core\Console\DS;

class WordPress
{
    /**
     * Connect the command line to WordPress when required.
     *
     * @param string|null $domain
     *
     * @return void
     * @throws CannotConnectToWordPressException
     */
    public static function connect(string|null $domain = null): void
    {
        $_SERVER['HTTP_HOST'] = $domain;

        // Connect to WordPress
        try {
            if (Bedrock::detected()) {
                @require_once(__DIR__ . DS . ".." . DS . ".." . DS . ".." . DS . ".." . DS . ".." . DS . ".." . DS . ".." . DS . ".." . DS . "wp" . DS . "wp-load.php");
            } else {
                @require_once(__DIR__ . DS . ".." . DS . ".." . DS . ".." . DS . ".." . DS . ".." . DS . ".." . DS . ".." . DS . ".." . DS . "wp-load.php");
            }
        } catch (\Throwable $e) {
            throw new CannotConnectToWordPressException($e->getMessage());
        }

        // Boot the theme
        Theme::boot();
    }
}
