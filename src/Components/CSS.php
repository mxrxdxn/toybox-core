<?php

namespace Toybox\Core\Components;

use Toybox\Core\Exceptions\PathDoesNotExistException;

class CSS
{
    /**
     * Inlines CSS styling for better page performance.
     *
     * @param string $handle
     * @param string $cssPath
     *
     * @return void
     * @throws PathDoesNotExistException
     */
    public static function inline(string $handle, string $cssPath): void
    {
        add_action("wp_enqueue_scripts", function () use ($handle, $cssPath) {
            if (! file_exists($cssPath)) {
                throw new PathDoesNotExistException("The given path \"{$cssPath}\" does not exist.");
            }

            $cssContent = file_get_contents($cssPath);

            if ($cssContent && ! empty($handle)) {
                wp_add_inline_style($handle, $cssContent);
            }
        });
    }
}
