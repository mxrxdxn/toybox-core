<?php

namespace Toybox\Core\Components;

use const Toybox\Core\Console\DS;

class Bedrock
{
    /**
     * On Bedrock installations, the path to wp-load.php is different - this
     * function figures out if we're on a Bedrock installation.
     *
     * @return bool
     */
    public static function detected(): bool
    {
        return file_exists(__DIR__ . DS . ".." . DS . ".." . DS . ".." . DS . ".." . DS . ".." . DS . ".." . DS . ".." . DS . ".." . DS . "wp" . DS . "");
    }
}
