<?php
/**
 * Register ajax variables
 * @return void
 */
function klyp_register_ajax_variables()
{
    $js_variables = [
        'ajax_url'                                              => admin_url('admin-ajax.php'),
        'klyp_generate_nonce'                                   => wp_create_nonce('klyp_generate_nonce'),
        'project_load_more'                                     => 'project_load_more',
        'project_list_refresh'                                  => 'project_list_refresh',
        'product_list_refresh'                                  => 'product_list_refresh',
        'gallery_refresh'                                       => 'gallery_refresh',
        'blogs_load_more'                                       => 'blogs_load_more',
        'live_search'                                           => 'live_search',
        'current_page'                                          => get_query_var('paged', 1),
        'themeUrl'                                              => get_stylesheet_directory_uri(),
    ];
    wp_localize_script('klyp-script', 'register_vars', $js_variables);
}
add_action('get_footer', 'klyp_register_ajax_variables', 20);