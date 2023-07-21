<?php
//Settings
$sectionShow           = get_sub_field('component_all_projects_lists_component_enabled');
$sectionId             = get_sub_field('component_all_projects_lists_field_id');
$sectionClass          = get_sub_field('component_all_projects_lists_field_class');

//Contents
$featureTitle           = get_sub_field('component_all_projects_list_title');

//Get 12 latest projects
global $wp_query;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$query = new WP_Query(array(
    'posts_per_page' => '12',
    'post_status' => 'publish',
    'post_type' => 'project',
    'tax_query' => array(
        'taxonomy' => 'project_category',
        'field' => 'slug',
        'terms' => 'commercial',
    ),
    'orderby' => 'post_date',
    'order' => 'desc',
    'paged' => $paged,
));
?>
<?php if ($sectionShow == true) : ?>
    <section id="<?= $sectionId ?>" class=" border-x border-black mx-4 sm:mx-6 py-16 sm:py-24 lg:py-36 <?= $sectionClass ?>">
        <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto w-full px-8">
            <div class="flex flex-col-reverse lg:flex-row gap-4 items-center">
                <h2 class="text-3xl lg:text-4xl">
                    <?= $featureTitle ?>
                </h2>
            </div>
            <hr class="border-t w-full my-8 border-black">
            <div class="flex justify-content-end -ml-8">
                <div class="section-product-list__masonry flex-grow-0 flex-shrink-0 basis-full max-w-full">
                    <?php
                    while ($query->have_posts()) {
                        $query->the_post();
                        $postTitle     = get_the_title();
                        $postLink      = get_permalink(get_the_ID());
                        $postImageUrl = get_the_post_thumbnail_url(get_the_ID());
                        require(get_template_directory() . '/template-parts/components/partial_projects_lists.php');
                        $index++;
                    }
                    wp_reset_query();
                    ?>
                </div>
            </div>
            <div class="pagination mt-8 border-t border-black pt-8 flex justify-center items-center gap-1">
                <?php

                // Prepare SVG icons for previous and next buttons
                $svg_prev = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                  <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
                </svg>';
                $svg_next = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                  <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                </svg>';


                $total_pages = $query->max_num_pages;
                if ($total_pages > 1) {
                    $current_page = max(1, get_query_var('paged'));

                    echo paginate_links(array(
                        'base'      => get_pagenum_link(1) . '%_%',
                        'format'    => 'page/%#%',
                        'current'   => $current_page,
                        'total'     => $total_pages,
                        'prev_text' => $svg_prev . __(' Prev'), // Add the SVG icon before "Prev"
                        'next_text' => __('Next ') . $svg_next, // Add the SVG icon after "Next"
                    ));
                }
                ?>
            </div>
        </div>
    </section>
<?php endif; ?>