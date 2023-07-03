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

    /**
     * Adds preloading for scripts and styles using native functionality.
     *
     * @return void
     */
    public static function preload(): void
    {
        add_action('wp_head', function () {
            global $wp_styles, $wp_scripts;

            $html = "";

            // Styles
            if (is_iterable($wp_styles->queue)) {
                foreach ($wp_styles->queue as $handle) {
                    if (! empty($wp_styles->registered[$handle]->src)) {
                        $html .= "<link rel='preload' as='style' href='{$wp_styles->registered[$handle]->src}'>" . PHP_EOL;
                    }
                }
            }

            // Scripts
            if (is_iterable($wp_scripts->queue)) {
                foreach ($wp_scripts->queue as $handle) {
                    if (! empty($wp_scripts->registered[$handle]->src)) {
                        $html .= "<link rel='preload' as='script' href='{$wp_scripts->registered[$handle]->src}'>" . PHP_EOL;
                    }
                }
            }

            echo $html;
        }, 1);
    }
}