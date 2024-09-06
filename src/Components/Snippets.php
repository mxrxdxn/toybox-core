<?php

namespace Toybox\Core\Components;

class Snippets
{
    /**
     * Allows loading of "snippets" - small bits of sharable code that can be dropped into any Toybox installation.
     *
     * @return void
     */
    public static function boot(): void
    {
        $path = get_template_directory() . "/snippets";

        if (file_exists($path)) {
            foreach (glob("{$path}/*.php") as $snippet) {
                require_once($snippet);
            }
        }
    }
}
