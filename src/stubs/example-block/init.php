<?php

use Toybox\Core\Components\ACF;
use Toybox\Core\Components\Blocks;

$assets = [
    "css" => [
        "example-block-css" => file_exists(\Toybox\Core\Components\Path::themeFile("/assets/css/blocks/example-block.css")) ? mix("/assets/css/blocks/example-block.css") : false,
    ],

    "js" => [
        "example-block-js" => file_exists(\Toybox\Core\Components\Path::themeFile("/assets/js/blocks/example-block.js")) ? mix("/assets/js/blocks/example-block.js") : false,
    ],
];

ACF::setSavePoint();
Blocks::registerAssets($assets);
register_block_type(__DIR__);
