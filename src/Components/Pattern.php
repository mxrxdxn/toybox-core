<?php

namespace Toybox\Core\Components;

class Pattern
{
    /**
     * Register a new pattern category.
     *
     * @param string $name The name of the category.
     * @param string $slug
     * @param array  $properties
     *
     * @return void
     */
    public static function registerCategory(string $name, string $slug, array $properties = [])
    {
        add_action("init", function () use ($name, $slug, $properties) {
            if (! empty($properties)) {
                register_block_pattern_category(
                    $slug,
                    $properties,
                );
            } else {
                register_block_pattern_category(
                    $slug,
                    [
                        'label' => __($name, 'toybox'),
                    ],
                );
            }
        });
    }

    public static function deregisterDefaultPatterns()
    {
        add_action("init", function () {
            remove_theme_support('core-block-patterns');
        }, 9);
    }
}