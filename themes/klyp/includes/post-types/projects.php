<?php
/**
*Project CPT
*/
function project_post_type() {

    $labels = array(
        'name'                  => _x( 'Projects', 'Post Type General Name', 'modinex' ),
        'singular_name'         => _x( 'Project', 'Post Type Singular Name', 'modinex' ),
        'menu_name'             => __( 'Projects', 'modinex' ),
        'name_admin_bar'        => __( 'Project', 'modinex' ),
        'archives'              => __( 'Project Archives', 'modinex' ),
        'attributes'            => __( 'Project Attributes', 'modinex' ),
        'parent_item_colon'     => __( 'Parent Project:', 'modinex' ),
        'all_items'             => __( 'All Projects', 'modinex' ),
        'add_new_item'          => __( 'Add New Project', 'modinex' ),
        'add_new'               => __( 'Add New Project', 'modinex' ),
        'new_item'              => __( 'New Project', 'modinex' ),
        'edit_item'             => __( 'Edit Project', 'modinex' ),
        'update_item'           => __( 'Update Project', 'modinex' ),
        'view_item'             => __( 'View Project', 'modinex' ),
        'view_items'            => __( 'View Projects', 'modinex' ),
        'search_items'          => __( 'Search Project', 'modinex' ),
        'not_found'             => __( 'Not found', 'modinex' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'modinex' ),
        'featured_image'        => __( 'Featured Image', 'modinex' ),
        'set_featured_image'    => __( 'Set featured image', 'modinex' ),
        'remove_featured_image' => __( 'Remove featured image', 'modinex' ),
        'use_featured_image'    => __( 'Use as featured image', 'modinex' ),
        'insert_into_item'      => __( 'Insert into Project', 'modinex' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Project', 'modinex' ),
        'items_list'            => __( 'Projects list', 'modinex' ),
        'items_list_navigation' => __( 'Projects list navigation', 'modinex' ),
        'filter_items_list'     => __( 'Filter Projects list', 'modinex' ),
    );
    $args = array(
        'label'                 => __( 'Project', 'modinex' ),
        'description'           => __( 'Project', 'modinex' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-format-status',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,        
        'exclude_from_search'   => false,
        'taxonomies'            => array( 'project_category' ),
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );
    register_post_type('project', $args);

}
add_action('init', 'project_post_type', 0);

/**
* Register Project Categories taxonomy
* return @void
*/
function register_taxonomy_project_categories() {
   $labels = array(
        'name'          => __('Project Categories', 'custom-post-type-ui'),
        'singular_name' => __('project_category', 'custom-post-type-ui'),
    );
    $args = array(
        'label'                 => __('project_category', 'custom-post-type-ui'),
        'labels'                => $labels,
        'public'                => true,
        'publicly_queryable'    => true,
        'hierarchical'          => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => true,
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'project_category', 'with_front' => true),
        'show_admin_column'     => false,
        'show_in_rest'          => true,
        'rest_base'             => 'project_category',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
        'show_in_quick_edit'    => false,
        );
    register_taxonomy('project_category', array('project'), $args);
}
add_action('init', 'register_taxonomy_project_categories');
?>
