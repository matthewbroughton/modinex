<?php

/**
 * Ajax function, to return more products from the current query
 * @return string
 */
function gallery_refresh()
{
    $paged = sanitize_text_field($_POST['page']);
    $gallery_option_list = explode(',', sanitize_text_field($_POST['gallery_option']));

    //Number of post per each Load More query
    $post_per_page = get_field('gallery_image_per_page', 'option');
    
    //Number of posts in initial page load
    $offset = get_field('gallery_image_per_page', 'option');

    //Since offset doesn't work together with paged, we will use offset as post per page are different
    $offset_paged = $paged + $offset;
    
    if (sanitize_text_field($_POST['gallery_option']) != '') {
        $args = array(
            'posts_per_page'        => $post_per_page,
            'paged'                 => $paged,
            'post_status'           => 'publish',
            'post_type'             => 'gallery',
            'tax_query'             => array(
                array(
                    'taxonomy'      => 'gallery_category',
                    'field'         => 'id',
                    'terms'         => $gallery_option_list,
                    'operator'      => 'IN',
                ),
            ),
            'orderby'               => 'post_date',
            'order'                 => 'desc',
        );
    } else {
        $args = array(
            'posts_per_page' => $post_per_page,
            'paged'          => $paged,
            'post_status'    => 'publish',
            'post_type'      => 'gallery',
            'orderby'        => 'post_date',
            'order'          => 'desc',
        );
    }

    $gallery_query = new WP_Query($args);

    //New max page number after adding the offset
    $maxPageNumber = $gallery_query->max_num_pages;

    while ($gallery_query->have_posts()) {
        $gallery_query->the_post();
        $gallery_title     = get_the_title();
        $gallery_link      = get_field('inspiration_gallery_link', get_the_ID());
        $gallery_link      = empty($gallery_link) ? 'javascript:void(0);' : $gallery_link['url'];
        $gallery_image_url = get_field('inspiration_gallery_image', get_the_ID());
        require(get_template_directory() . '/template-parts/components/gallery_archive_template.php');
    }
    wp_reset_query();
    wp_die();
}
add_action('wp_ajax_nopriv_gallery_refresh', 'gallery_refresh');
add_action('wp_ajax_gallery_refresh', 'gallery_refresh');
?>