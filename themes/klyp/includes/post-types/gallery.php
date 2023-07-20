<?php
/** 
* Register Gallery Type
* @return @void
*/
function gallery_post_type() {

    $labels = array(
        'name'                  => _x( 'Galleries', 'Post Type General Name', 'modinex' ),
        'singular_name'         => _x( 'Gallery', 'Post Type Singular Name', 'modinex' ),
        'menu_name'             => __( 'Gallery', 'modinex' ),
        'name_admin_bar'        => __( 'Gallery', 'modinex' ),
        'archives'              => __( 'Gallery Archives', 'modinex' ),
        'attributes'            => __( 'Gallery Attributes', 'modinex' ),
        'parent_item_colon'     => __( 'Parent Gallery:', 'modinex' ),
        'all_items'             => __( 'All Galleries', 'modinex' ),
        'add_new_item'          => __( 'Add New Gallery', 'modinex' ),
        'add_new'               => __( 'Add New Gallery', 'modinex' ),
        'new_item'              => __( 'New Gallery', 'modinex' ),
        'edit_item'             => __( 'Edit Gallery', 'modinex' ),
        'update_item'           => __( 'Update Gallery', 'modinex' ),
        'view_item'             => __( 'View Gallery', 'modinex' ),
        'view_items'            => __( 'View Galleries', 'modinex' ),
        'search_items'          => __( 'Search Gallery', 'modinex' ),
        'not_found'             => __( 'Not found', 'modinex' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'modinex' ),
        'featured_image'        => __( 'Featured Image', 'modinex' ),
        'set_featured_image'    => __( 'Set featured image', 'modinex' ),
        'remove_featured_image' => __( 'Remove featured image', 'modinex' ),
        'use_featured_image'    => __( 'Use as featured image', 'modinex' ),
        'insert_into_item'      => __( 'Insert into Gallery', 'modinex' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Gallery', 'modinex' ),
        'items_list'            => __( 'Galleries list', 'modinex' ),
        'items_list_navigation' => __( 'Galleries list navigation', 'modinex' ),
        'filter_items_list'     => __( 'Filter Galleries list', 'modinex' ),
    );
    $args = array(
        'label'                 => __( 'Gallery', 'modinex' ),
        'description'           => __( 'Gallery', 'modinex' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-layout',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,        
        'exclude_from_search'   => false,
        'taxonomies'            => array( 'gallery_category' ),
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );
    register_post_type('gallery', $args);
    remove_post_type_support('gallery', 'editor');

}
add_action('init', 'gallery_post_type', 0);

/**
* Register Gallery Categories taxonomy
* @return @void
*/
function register_taxonomy_gallery_categories() {
   $labels = array(
        'name'          => __('Gallery Categories', 'custom-post-type-ui'),
        'singular_name' => __('gallery_category', 'custom-post-type-ui'),
    );
    $args = array(
        'label'                 => __('gallery_category', 'custom-post-type-ui'),
        'labels'                => $labels,
        'public'                => true,
        'publicly_queryable'    => true,
        'hierarchical'          => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => true,
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'gallery_category', 'with_front' => true),
        'show_admin_column'     => false,
        'show_in_rest'          => true,
        'rest_base'             => 'gallery_category',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
        'show_in_quick_edit'    => false,
        );
    register_taxonomy('gallery_category', array('gallery'), $args);
}
add_action('init', 'register_taxonomy_gallery_categories');