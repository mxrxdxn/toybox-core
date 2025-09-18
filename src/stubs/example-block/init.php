<?php

use Toybox\Core\Components\ACF;
use Toybox\Core\Components\Blocks;

$assets = [
    "css" => [
        "example-block-css" => vite("blocks/example-block/resources/css/example-block.css"),
    ],

    "js" => [
        "example-block-js" => vite("blocks/example-block/resources/js/example-block.js"),
    ],
];

ACF::setSavePoint();
Blocks::registerAssets($assets);
register_block_type(__DIR__);
