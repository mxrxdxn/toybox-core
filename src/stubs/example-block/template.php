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

$id = 'example-' . $block['id'];

?>

<?php if (Blocks::isPreview($block)) : ?>
    <?php
    $blockName = basename(dirname(__FILE__));
    $path      = uri("/blocks/{$blockName}/preview.png");
    ?>
    <?= Blocks::preview($block, $path); ?>
<?php return; endif; ?>

<div class="block-example <?= $block['className'] ?? "" ?>" id="<?= $id ?>">
    <!-- Your block content goes here. -->
</div>