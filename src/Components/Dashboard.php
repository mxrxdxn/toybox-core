<?php

namespace Toybox\Core\Components;

class Dashboard
{
    /**
     * Render a widget in the Dashboard area of WordPress's admin area.
     *
     * @param string $widgetID    A unique ID for the widget.
     * @param string $widgetTitle The title of the widget.
     * @param string $widgetHTML  The HTML content for the widget.
     *
     * @return void
     */
    public static function addWidget(string $widgetID, string $widgetTitle, string $widgetHTML)
    {
        add_action("wp_dashboard_setup", function () use ($widgetID, $widgetTitle, $widgetHTML) {
            global $wp_meta_boxes;

            wp_add_dashboard_widget($widgetID, $widgetTitle, function () use ($widgetHTML) {
                echo $widgetHTML;
            });
        });
    }
}
