<?php
function blogs_load_more() {
	$paged = sanitize_text_field($_POST['page']) + 1;
    $args = array(
        'posts_per_page' => get_field('blog_post_per_page', 'option'),
        'paged' => $paged,
        'post_type' => 'post',
        'orderby' => 'post_date',
        'order' => 'desc',
    );
    

    $blogs_query = new WP_Query($args);
    $maxPageNumber = $blogs_query->max_num_pages;
    while ($blogs_query->have_posts()) { 
        $blogs_query->the_post();
        $blogs_title     = get_the_title();
        $blogs_link      = get_permalink(get_the_ID());
        $blogs_image_url = get_the_post_thumbnail_url(get_the_ID());
        require(get_template_directory() . '/template-parts/components/blogs_archive_template.php');
    }
    wp_die();
}
add_action('wp_ajax_nopriv_blogs_load_more', 'blogs_load_more');
add_action('wp_ajax_blogs_load_more', 'blogs_load_more');
?>