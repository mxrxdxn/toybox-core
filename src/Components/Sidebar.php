<?php

namespace Toybox\Core\Components;

class Sidebar
{
    /**
     *
     * @param array $args
     *
     * @return void
     */
    public static function register(array $args = []): void
    {
        add_action("widgets_init", function ($args) {
            register_sidebar(array_merge([
                "id"            => "custom_sidebar",
                "name"          => __("Custom Sidebar"),
                "description"   => __("A custom widget area."),
                "before_title"  => '<h3 class="widget-title">',
                "after_title"   => '</h3>',
                "before_widget" => '<aside id="%1$s" class="widget %2$s">',
                "after_widget"  => '</aside>',
            ]));
        });
    }
}
