<?php

use Toybox\Core\Components\ACF;
use Toybox\Core\Components\Blocks;

$assets = [
    // "css" => [
    //     "example-block-css" => mix("/assets/css/blocks/example-block.css") ?? false,
    // ],

    // "js" => [
    //     "example-block-js" => mix("/assets/js/blocks/example-block.js") ?? false,
    // ],
];

ACF::setSavePoint("Example Block");
Blocks::registerAssets($assets);
register_block_type(__DIR__);
