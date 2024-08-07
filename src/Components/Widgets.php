<?php

namespace Toybox\Core\Components;

class Widgets
{
    /**
     * Unregisters default widgets if they aren't being used.
     *
     * @return void
     */
    public static function unregisterDefaults(): void
    {
        add_action('widgets_init', function () {
            unregister_widget('WP_Widget_Pages');
            unregister_widget('WP_Widget_Calendar');
            unregister_widget('WP_Widget_Archives');
            unregister_widget('WP_Widget_Links');
            unregister_widget('WP_Widget_Meta');
            unregister_widget('WP_Widget_Search');
            unregister_widget('WP_Widget_Text');
            unregister_widget('WP_Widget_Categories');
            unregister_widget('WP_Widget_Recent_Posts');
            unregister_widget('WP_Widget_Recent_Comments');
            unregister_widget('WP_Widget_RSS');
            unregister_widget('WP_Widget_Tag_Cloud');
        }, 1);
    }
}
