<?php

// Register Custom Post Type "SLUGGED_SINGULAR_POST_TYPE"
register_post_type('SLUGGED_SINGULAR_POST_TYPE', [
    'label'               => __('SINGULAR_POST_TYPE', 'toybox'),
    'description'         => __('My custom post type.', 'toybox'),
    'labels'              => [
        'name'                  => _x('PLURAL_POST_TYPE', 'Post Type General Name', 'toybox'),
        'singular_name'         => _x('SINGULAR_POST_TYPE', 'Post Type Singular Name', 'toybox'),
        'menu_name'             => __('PLURAL_POST_TYPE', 'toybox'),
        'name_admin_bar'        => __('SINGULAR_POST_TYPE', 'toybox'),
        'archives'              => __('Item Archives', 'toybox'),
        'attributes'            => __('Item Attributes', 'toybox'),
        'parent_item_colon'     => __('Parent Item:', 'toybox'),
        'all_items'             => __('All Items', 'toybox'),
        'add_new_item'          => __('Add New Item', 'toybox'),
        'add_new'               => __('Add New', 'toybox'),
        'new_item'              => __('New Item', 'toybox'),
        'edit_item'             => __('Edit Item', 'toybox'),
        'update_item'           => __('Update Item', 'toybox'),
        'view_item'             => __('View Item', 'toybox'),
        'view_items'            => __('View Items', 'toybox'),
        'search_items'          => __('Search Item', 'toybox'),
        'not_found'             => __('Not found', 'toybox'),
        'not_found_in_trash'    => __('Not found in Trash', 'toybox'),
        'featured_image'        => __('Featured Image', 'toybox'),
        'set_featured_image'    => __('Set featured image', 'toybox'),
        'remove_featured_image' => __('Remove featured image', 'toybox'),
        'use_featured_image'    => __('Use as featured image', 'toybox'),
        'insert_into_item'      => __('Insert into item', 'toybox'),
        'uploaded_to_this_item' => __('Uploaded to this item', 'toybox'),
        'items_list'            => __('Items list', 'toybox'),
        'items_list_navigation' => __('Items list navigation', 'toybox'),
        'filter_items_list'     => __('Filter items list', 'toybox'),
    ],
    'supports'            => ['title', 'editor', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats'],
    'taxonomies'          => ['category', 'post_tag'],
    'hierarchical'        => true,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'menu_position'       => 5,
    'show_in_admin_bar'   => true,
    'show_in_nav_menus'   => true,
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'page',
    'show_in_rest'        => true,
]);
