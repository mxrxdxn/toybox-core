<?php

/**
 * Example Block Template.
 *
 * @var array      $block      The block settings and attributes.
 * @var string     $content    The block inner HTML (empty).
 * @var bool       $is_preview True during AJAX preview.
 * @var int|string $post_id    The post ID this block is saved to.
 */

use Toybox\Core\Components\Blocks;

// Block ID
$id = 'example-' . $block['id'];

// Handle block previews
if (Blocks::isPreview($block)) {
    $blockName = basename(dirname(__FILE__));
    $path      = uri("/blocks/{$blockName}/preview.png");

    echo Blocks::preview($block, $path);
    return;
}

// If you have any custom logic, you should put it under here.

?>

<div class="block-example <?= $block['className'] ?? "" ?>" id="<?= $id ?>">
    <!-- Your block content goes here. -->
</div>