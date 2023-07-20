<?php
/**
* Include custom post type to WordPress functions
*
*/

/**
 * Add Projects post type.
 */
require get_template_directory() . '/includes/post-types/projects.php';

/**
 * Add Resellers post type.
 */
require get_template_directory() . '/includes/post-types/resellers.php';

/**
 * Add Gallery post type.
 */
require get_template_directory() . '/includes/post-types/gallery.php';
?>
