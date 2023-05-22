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
}