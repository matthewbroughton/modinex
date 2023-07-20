<?php
/**
 * Adds ACF.
 */
require get_template_directory() . '/includes/acf.php';

/**
 * Adds Menu functions.
 */
require get_template_directory() . '/includes/menu.php';

/**
 * Adds Menu functions.
 */
require get_template_directory() . '/includes/footer.php';

/**
 * Adds Reseller functions.
 */
require get_template_directory() . '/includes/reseller.php';

/**
 * Include custom post type
 */
require get_template_directory() . '/includes/post-types/custom-post-types.php';

/**
 * Include ajax function
 */
require get_template_directory() . '/includes/ajax.php';

/*
 * Ajax function for project post type
 */
require get_template_directory() . '/includes/projects_ajax.php';

/*
 * Ajax function for product post type
 */
require get_template_directory() . '/includes/products_ajax.php';

/*
 * Ajax function for blog post type
 */
require get_template_directory() . '/includes/blogs_ajax.php';

/*
 * Ajax function for blog post type
 */
require get_template_directory() . '/includes/gallery_ajax.php';

/*
 * Ajax function for live search
 */
require get_template_directory() . '/includes/live_search.php';

/**
 * Adds extra site settings acf field for site.
 */
require get_template_directory() . '/includes/site-settings-acf.php';

/**
 * Adds extra settings acf field for product category.
 */
require get_template_directory() . '/includes/product-category-settings-acf.php';
?>