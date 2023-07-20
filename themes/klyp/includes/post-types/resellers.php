<?php
/** 
* Register Reseller Location Type
* @return @void
*/
function reseller_location_post_type() {

    $labels = array(
        'name'                  => _x( 'Reseller Locations', 'Post Type General Name', 'modinex' ),
        'singular_name'         => _x( 'Reseller Location', 'Post Type Singular Name', 'modinex' ),
        'menu_name'             => __( 'Reseller Locations', 'modinex' ),
        'name_admin_bar'        => __( 'Reseller Location', 'modinex' ),
        'archives'              => __( 'Reseller Location Archives', 'modinex' ),
        'attributes'            => __( 'Reseller Location Attributes', 'modinex' ),
        'parent_item_colon'     => __( 'Parent Reseller Location:', 'modinex' ),
        'all_items'             => __( 'All Reseller Locations', 'modinex' ),
        'add_new_item'          => __( 'Add New Reseller Location', 'modinex' ),
        'add_new'               => __( 'Add New Reseller Location', 'modinex' ),
        'new_item'              => __( 'New Reseller Location', 'modinex' ),
        'edit_item'             => __( 'Edit Reseller Location', 'modinex' ),
        'update_item'           => __( 'Update Reseller Location', 'modinex' ),
        'view_item'             => __( 'View Reseller Location', 'modinex' ),
        'view_items'            => __( 'View Reseller Locations', 'modinex' ),
        'search_items'          => __( 'Search Reseller Location', 'modinex' ),
        'not_found'             => __( 'Not found', 'modinex' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'modinex' ),
        'featured_image'        => __( 'Featured Image', 'modinex' ),
        'set_featured_image'    => __( 'Set featured image', 'modinex' ),
        'remove_featured_image' => __( 'Remove featured image', 'modinex' ),
        'use_featured_image'    => __( 'Use as featured image', 'modinex' ),
        'insert_into_item'      => __( 'Insert into Reseller Location', 'modinex' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Reseller Location', 'modinex' ),
        'items_list'            => __( 'Reseller Locations list', 'modinex' ),
        'items_list_navigation' => __( 'Reseller Locations list navigation', 'modinex' ),
        'filter_items_list'     => __( 'Filter Reseller Locations list', 'modinex' ),
    );
    $args = array(
        'label'                 => __( 'Reseller Location', 'modinex' ),
        'description'           => __( 'Reseller Location', 'modinex' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-location-alt',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,        
        'exclude_from_search'   => false,
        'taxonomies'            => array( 'reseller_location_category' ),
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );
    register_post_type('reseller_location', $args);

}
add_action('init', 'reseller_location_post_type', 0);

/**
* Register Reseller Location Categories taxonomy
* @return @void
*/
function register_taxonomy_reseller_location_categories() {
   $labels = array(
        'name'          => __('Reseller Location Categories', 'custom-post-type-ui'),
        'singular_name' => __('reseller_location_category', 'custom-post-type-ui'),
    );
    $args = array(
        'label'                 => __('reseller_location_category', 'custom-post-type-ui'),
        'labels'                => $labels,
        'public'                => true,
        'publicly_queryable'    => true,
        'hierarchical'          => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => true,
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'reseller_location_category', 'with_front' => true),
        'show_admin_column'     => false,
        'show_in_rest'          => true,
        'rest_base'             => 'reseller_location_category',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
        'show_in_quick_edit'    => false,
        );
    register_taxonomy('reseller_location_category', array('reseller_location'), $args);
}
add_action('init', 'register_taxonomy_reseller_location_categories');