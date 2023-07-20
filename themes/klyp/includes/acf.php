<?php
/**
 * Activate ACF Pro
 * @param string
 * @param string
 * @return void
 */
function klyp_plugin_activation_acf($plugin, $network_activation)
{
    if (strpos($plugin, 'acf.php') && ! get_option('acf_pro_license', false)) {
        $save = array(
            'key' => "b3JkZXJfaWQ9NDUxMzN8dHlwZT1wZXJzb25hbHxkYXRlPTIwMTQtMTEtMjcgMDQ6MTg6MDk=",
            'url' => home_url()
        );
        $save = maybe_serialize($save);
        $save = base64_encode($save);
        update_option('acf_pro_license', $save);
    }
}

add_action('activated_plugin', 'klyp_plugin_activation_acf', 10, 2);

/**
 * Save ACF into JSON
 * @param string
 * @return string
 */
function klyp_acf_json_save_folder($path)
{
    $path = get_template_directory() . '/includes/acf-json';
    return $path;
}

/**
 * Load ACF from JSON
 * @param string
 * @return string
 */
function klyp_acf_json_load_folder($paths)
{
    unset($paths[0]);
    $paths[] = get_template_directory() . '/includes/acf-json';
    return $paths;
}

// If acf is installed
if (class_exists('acf')) {
    // Save ACF to jsons
    add_filter('acf/settings/save_json', 'klyp_acf_json_save_folder');

    // Load ACF from jsons
    add_filter('acf/settings/load_json', 'klyp_acf_json_load_folder');

    // Enable shortcode on wysiwyg
    add_filter('acf/format_value/type=wysiwyg', 'do_shortcode');

    // add theme site settings menu option for admin only
    if (current_user_can('administrator')) {
        acf_add_options_page(
            array(
                'page_title' => 'Site Settings',
                'menu_title' => 'Site Settings',
                'menu_slug' => 'site-settings',
                'capability' => 'edit_posts',
                'redirect' => false,
                'position' => 2
            )
        );
    }

    // Set components
    $components = array(
        'page_hero',
        'home_introduction',
        'feature_call_to_action',
        'home_hero',
        'callout_banner',
        'full_width_text',
        'media_grid',
        'text_tabs',
        'gallery_tabs',
        'contact_us_section',
        'featured_projects',
        'horizontal_columns',
        'inspiration_gallery',
        'sidebyside',
        'text_sliders',
        'all_projects_lists',
        'projects_showcase',
        'latest_news',
        'contact_us_intro',
        'sidebyside_texts',
        'image_gallery',
    );

    // Set project components
    $projects_components = array(
        'overlaid_images',
        'mini_projects_lists',
    );

    // Set product details components
    $product_details_components = array (
        'hero',
        'how_it_works',
        'features_benefits',
        'downloads',
        'size_specifications',
        'client_reviews',
        'gallery',
    );

    //General components
    $component_fields = array();
    // Generate components
    foreach ($components as $component) {
        require get_parent_theme_file_path('/includes/components/' . $component . '.php');
        $component_fields = array_merge($component_fields, $fields);
    }

    //Product details components
    $product_details_component_fields = array();
    //Generate components
    foreach ($product_details_components as $product_details_component) {
        require get_parent_theme_file_path('/includes/components/product-details/' . $product_details_component . '.php');
        $product_details_component_fields = array_merge($product_details_component_fields, $fields);
    }

    $projects_components_fields = array();
    //Generate components
    foreach ($projects_components as $projects_component) {
        require get_parent_theme_file_path('/includes/components/projects/' . $projects_component . '.php');
        $projects_components_fields = array_merge($projects_components_fields, $fields);
    }

    require_once get_template_directory() . '/includes/components/index.php';
}