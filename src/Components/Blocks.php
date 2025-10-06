<?php

namespace Toybox\Core\Components;

class Blocks
{
    /**
     * Autoload blocks from the /blocks directory.
     *
     * @return void
     */
    public static function boot(): void
    {
        $path = get_template_directory() . "/blocks";

        if (file_exists($path)) {
            foreach (glob("{$path}/*") as $blockDir) {
                // Load the block
                add_action("init", function () use ($blockDir) {
                    // We use a file existence check here as we may be supporting newer block types.
                    if (file_exists("{$blockDir}/block.json")) {
                        require_once("{$blockDir}/init.php");
                    } else {
                        // Perform an additional check to ensure we have ACF installed.
                        if (function_exists('acf_register_block_type')) {
                            require_once("{$blockDir}/init.php");
                        }
                    }
                }, 5);
            }
        }
    }

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
                            $split = explode("?id=", $asset);
                            $url   = $split[0];

                            wp_register_style($assetHandle, $url, []);
                        }
                    }

                    break;

                case "js":
                    foreach ($assetList as $assetHandle => $asset) {
                        if ($asset) {
                            $split = explode("?id=", $asset);
                            $url   = $split[0];

                            wp_register_script($assetHandle, $url, []);
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

    /**
     * Parses blocks from a content string into HTML.
     *
     * @param string $content
     *
     * @return string
     */
    public static function renderContentString(string $content): string
    {
        $blocks = static::parse($content);
        $output = "";

        foreach ($blocks as $block) {
            $output .= render_block($block);
        }

        return $output;
    }

    /**
     * Parses blocks from a content string.
     *
     * @param string $content
     *
     * @return array
     */
    public static function parse(string $content): array
    {
        return parse_blocks($content);
    }

    /**
     * Returns a formatted string for use inside the `allowedBlocks` attribute on an <InnerBlocks> element.
     *
     * @see https://developer.wordpress.org/block-editor/reference-guides/core-blocks/
     *
     * @param array $allowedBlocks An array of block names, including namespaces.
     *
     * @return string
     */
    public static function allowedBlocks(array $allowedBlocks): string
    {
        return esc_attr(wp_json_encode($allowedBlocks));
    }

    /**
     * Detect if the block is in preview mode or not.
     *
     * @param array $block
     *
     * @return bool
     */
    public static function isPreview(array $block): bool
    {
        return ! empty($block['data']['is_example']);
    }

    /**
     * Render a block preview.
     *
     * @param array  $block The block settings.
     * @param string $path  The path to the preview image.
     *
     * @return string
     */
    public static function preview(array $block, string $path): string
    {
        return "<figure><img style=\"width: 100%; height: 100%; object-fit: contain;\" src=\"{$path}\" alt=\"preview\" /></figure>";
    }
}
