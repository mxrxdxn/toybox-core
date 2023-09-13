<?php

namespace Toybox\Core\Components;

class Blocks
{
    /**
     * Registers block assets for use in WordPress.
     *
     * @param array $assets
     *
     * @return void
     */
    public static function registerAssets(array $assets): void
    {
        foreach ($assets as $assetType => $assetList) {
            switch ($assetType) {
                case "css":
                    foreach ($assetList as $assetHandle => $asset) {
                        if ($asset) {
                            $split       = explode("?id=", $asset);
                            $url         = $split[0];
                            $cacheBuster = $split[1];

                            wp_register_style($assetHandle, $url, [], $cacheBuster);
                        }
                    }

                    break;

                case "js":
                    foreach ($assetList as $assetHandle => $asset) {
                        if ($asset) {
                            $split       = explode("?id=", $asset);
                            $url         = $split[0];
                            $cacheBuster = $split[1];

                            wp_register_script($assetHandle, $url, [], $cacheBuster);
                        }
                    }

                    break;
            }
        }
    }

    /**
     * Disable inner block wrapping on the frontend.
     *
     * @param array $blockNames
     *
     * @return void
     */
    public static function disableWrap(array $blockNames): void
    {
        add_filter('acf/blocks/wrap_frontend_innerblocks', function ($wrap, $name) use ($blockNames) {
            if (in_array($name, $blockNames)) {
                return false;
            }

            return true;
        }, 10, 2);
    }

    /**
     * Render a block, outside of Gutenberg.
     *
     * @param string $blockName The namespace/name of the block. Toybox blocks are usually prefixed as toybox/{name}.
     * @param array  $data      An array of data to load into the block, which will be used by all get_field calls.
     *
     * @return void
     */
    public static function render(string $blockName, array $data = []): void
    {
        acf_render_block([
            'id'   => uniqid('block_'),
            'name' => $blockName,
            'data' => $data,
        ]);
    }
}