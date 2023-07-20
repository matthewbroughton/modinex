<?php
/**
 * Klyp functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Klyp
 */

if (! function_exists('klyp_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function klyp_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Klyp, use a find and replace
         * to change 'klyp' to the name of your theme in all the template files.
         */
        load_theme_textdomain('klyp', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'menu-1' => esc_html__('Primary', 'klyp'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery'
        ));

        /*
        * Remove Woocommerce stylesheet
        */
        add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
    }
endif;
add_action('after_setup_theme', 'klyp_setup');

/**
 * Enqueue scripts and styles.
 */
function klyp_scripts()
{
    wp_enqueue_style('klyp-default-style', get_stylesheet_uri());
    // wp_enqueue_style('klyp-style', get_template_directory_uri() . '/assets/dist/css/main.min.css');
    wp_enqueue_style('flickity-style', get_template_directory_uri() . '/assets/dist/css/flickity.min.css');
    wp_enqueue_style('tailwind-style', get_template_directory_uri() . '/assets/dist/css/output.css');
    wp_enqueue_script('klyp-script', get_template_directory_uri() . '/assets/dist/js/main.js', array('jquery'), '20200323', true);
    wp_enqueue_script('flickity-script', get_template_directory_uri() . '/assets/dist/js/flickity.pkgd.min.js');
    wp_enqueue_style('neue-haas-grotesk', 'https://use.typekit.net/xmn4fkl.css');
    wp_enqueue_script('google-maps', '//maps.googleapis.com/maps/api/js?&key=' . get_field('google_map_api_key', 'option') . '&libraries=places,geometry', array(), '3000', true);
}

add_action('wp_enqueue_scripts', 'klyp_scripts');

/**
 * Custom Functions
 */
require get_template_directory() . '/includes/index.php';

/**
 * Disable Gutenberg
 */
add_filter('use_block_editor_for_post', '__return_false', 10);
add_filter('use_block_editor_for_post_type', '__return_false', 10);
add_filter('gutenberg_use_widgets_block_editor', '__return_false');
add_filter('use_widgets_block_editor', '__return_false');

/**
 * Allow svg upload.
 */
function klyp_cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';

    // we don't want executables
    unset($mimes['exe']);
    return $mimes;
}

add_filter('upload_mimes', 'klyp_cc_mime_types');

/**
 * Remove comment support
 */
function klyp_remove_comment_support()
{
    remove_post_type_support('page', 'comments');
    remove_post_type_support('post', 'comments');
}

add_action('init', 'klyp_remove_comment_support', 100);

/**
 * Change default wordpress email address
 */
function klyp_wpb_sender_email($email)
{
    return get_bloginfo('admin_email');
}

add_filter('wp_mail_from', 'klyp_wpb_sender_email');

/**
 * Change default wordpress sender name
 */
function klyp_wpb_sender_name($email_from)
{
    return get_bloginfo('name');
}

add_filter('wp_mail_from_name', 'klyp_wpb_sender_name');

/**
 * Add site wide header script
 * @return void
 */
function klyp_hook_head()
{
    echo get_field('script_header_field', 'options');
}
add_action('wp_head', 'klyp_hook_head');

/**
 * Inject script on body for version 5.2.0 and up
 *
 * @return string
 */
function klyp_hook_body_v5() {
    echo get_field('script_body_field', 'options');
}

/**
 * Add site wide body script
 * @param  array
 * @return string
 */
function klyp_hook_body($classes)
{
    $classes[] = '">' . get_field('script_body_field', 'options') . '<noscript></noscript novar="';
    return $classes;
}

// making sure backward compatible
if (version_compare(get_bloginfo('version'), '5.2', '>=')) {
    add_filter('wp_body_open', 'klyp_hook_body_v5', PHP_INT_MAX);
} else {
    add_filter('body_class', 'klyp_hook_body', PHP_INT_MAX);
}

/**
 * Add site wide footer script
 * @return void
 */
function klyp_hook_footer()
{
    echo get_field('script_footer_field', 'options');
}
add_action('wp_footer', 'klyp_hook_footer');

/**
 * Get the array for the product option dependency based on the product dependency repeater.
 *
 * @param array $productOptionsFields product options array.
 * @param string $postId productid.
 *
 * @return array
 */
function get_the_product_dependency_options($productOptionsFields, $postId)
{
    $max = get_post_meta($postId, 'product_option_dependency', true);
    $types = array();
    foreach ($productOptionsFields as $productOption) {
        $type = strtolower(str_replace(' ', '_', trim($productOption['product_option_type'])));
        if (! in_array($type, $types)) {
            $types[] = strtolower(str_replace(' ', '_', $type));
        }
    }
    $allDependency = get_field('product_option_dependency', $postId);
    if (! empty($allDependency)) {
        foreach ($allDependency as $index => $dependency) {
            $trimmedDependencyValue = str_replace(', ',',', $dependency['product_option_dependency_value']);
            $dependencies[$index] = explode(',', strtolower(str_replace(' ', '_', $trimmedDependencyValue)));
            $dependencyImgUrl[$index] = $dependency['product_option_dependency_image'];
        }
    }
    if (! empty($types) && is_array($types)) {
        array_push($types, 'image');
        for ($i = 0; $i < $max; $i ++) {
            foreach ($types as $key => $type) {
                if ($type == 'image') {
                    $productDepValue[$i][$type] = $dependencyImgUrl[$i];
                } else {
                    $productDepValue[$i][$type] = $dependencies[$i][$key];
                }
            }
        }
    }

    return $productDepValue;
}

/**
 * Overwrite args of custom post type registered by plugin
 */
add_filter('register_post_type_args', 'change_capabilities_of_custom_posts' , 10, 2);

function change_capabilities_of_custom_posts($args, $post_type) {

    // Do not filter any other post type
    if ($post_type !== 'project' && $post_type !== 'gallery' && $post_type !== 'reseller_location') {
        // Give other post_types their original arguments
        return $args;
    }
    // Change the capabilities of the custom post type
    $args['capabilities'] = array(
        'edit_post' => 'edit_' . $post_type,
        'edit_posts' => 'edit_' . $post_type . 's',
        'edit_others_posts' => 'edit_other_' . $post_type . 's',
        'publish_posts' => 'publish_' . $post_type . 's',
        'read_post' => 'read_' . $post_type,
        'read_private_posts' => 'read_private_' . $post_type . 's',
        'delete_post' => 'delete_' . $post_type
    );
    // Give the custom post type it's arguments
    return $args;
}

/**
* add custom post capability to admin by default
*/
add_action('admin_init', 'add_cpt_cap_to_admin', 999);

function add_cpt_cap_to_admin() {
    add_role('support', 'Support',
        array(
            'read'          => true, // Allows a user to read
            'edit_posts'    => true, // Allows user to edit their own posts
        )
    );
    $role = get_role('support');
    $role->add_cap('wp_mail_logging_own_view_log');

    if (! current_user_can('administrator')) {
       remove_menu_page('edit-comments.php'); // Comments
       remove_menu_page('wpcf7'); // Contact Form 7 Menu
    }

    $args = array(
        'public'   => true,
        '_builtin' => false
    );

    $output = 'names'; // names or objects, note names is the default
    $operator = 'and'; // 'and' or 'or'

    $post_types = get_post_types($args, $output, $operator);

    $role = get_role('administrator');
    $role->add_cap('wp_mail_logging_own_view_log');
    foreach ($post_types  as $post_type) {
        if ($post_type !== 'product'){
            $role->add_cap('read_' . $post_type);
            $role->add_cap('edit_' . $post_type);
            $role->add_cap('edit_' . $post_type . 's');
            $role->add_cap('edit_other_' . $post_type . 's');
            $role->add_cap('edit_published_' . $post_type . 's');
            $role->add_cap('publish_' . $post_type . 's');
            $role->add_cap('read_private_' . $post_type . 's');
            $role->add_cap('delete_' . $post_type);
        }
    }
}
