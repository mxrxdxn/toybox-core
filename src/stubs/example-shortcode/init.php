<?php

use Toybox\Core\Components\Shortcode;

Shortcode::add('example-shortcode', function ($attributes) {
    // Build the attributes
    $attributes = Shortcode::attributes([
        // 'key' => 'default value',
    ], $attributes, 'example-shortcode');

    // Return a string
    // return "";

    // Return a template
    ob_start();
    get_template_part('shortcodes/example-shortcode/template', null, $attributes);
    return ob_get_clean();
});
