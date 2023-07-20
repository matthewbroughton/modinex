<?php
/**
 * Called from Ajax function
 * Goal : to refresh project posts by its attributes
 * @return string
 */
function project_list_refresh()
{
    $paged = sanitize_text_field($_POST['page']);
    
    $projectOptionList = json_decode(stripslashes($_POST['project_option']));

    //Number of post per each Load More query
    $postPerPage = get_field('projects_per_page', 'option');
    
    //Number of posts in initial page load
    $offset = get_field('projects_per_page', 'option');

    //Check if triggered by Load More button, then set offset value accordingly 
    $loadmore = $_POST['loadmore'];

    if ($loadmore == 0) {
        $offsetPaged = 1;
    } else {
        //Since offset doesn't work together with paged, we will use offset as post per page are different
        $offsetPaged = $paged + $offset;
    }

    if (! empty($projectOptionList) || $projectOptionList != '') {
        $args = array(
            'posts_per_page'        => $postPerPage,
            'post_status'           => 'publish',
            'paged'                 => $paged,
            'post_type'             => 'project',
            'tax_query'             => array(
                array(
                    'taxonomy'      => 'project_category',
                    'field'         => 'term_id',
                    'terms'         => $projectOptionList,
                    'operator'      => 'IN',
                ),
            ),
            'orderby'               => 'post_date',
            'order'                 => 'desc',
        );
    } else {
        $args = array(
            'posts_per_page' => $postPerPage,
            'post_status'    => 'publish',
            'paged'          => $paged,
            'post_type'      => 'project',
            'orderby'        => 'post_date',
            'order'          => 'desc',
        );
    }

    $index = 0;
    $query = new WP_Query($args);

    //New max page number after adding the offset
    // $maxPageNumber = $query->max_num_pages - floor($offset/$postPerPage);
    $maxPageNumber = $query->max_num_pages;
    while ($query->have_posts()) {
        $query->the_post();
        $postTitle     = get_the_title();
        $postLink      = get_permalink(get_the_ID());
        $postImageUrl = get_the_post_thumbnail_url(get_the_ID());
        require(get_template_directory() . '/template-parts/components/partial_projects_lists.php');
        $index++;
    }
    wp_reset_query();
    wp_die();
}
add_action('wp_ajax_nopriv_project_list_refresh', 'project_list_refresh');
add_action('wp_ajax_project_list_refresh', 'project_list_refresh');
?>