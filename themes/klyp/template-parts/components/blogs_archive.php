<?php
// Contents
$section_tile = get_sub_field('blogs_archive_title');

// Get 12 latest blogs
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$blogs_per_page = get_field('blog_post_per_page', 'option');
$blogs_query = new WP_Query(array(
    'posts_per_page' => $blogs_per_page,
    'post_type' => 'post',
    'orderby' => 'post_date',
    'order' => 'desc',
    'paged' => $paged,
));
?>

<section class="border-x border-black mx-4 sm:mx-6 py-16 sm:py-24 lg:py-36">
    <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto w-full px-8">
        <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-8 xl:gap-12 blog_posts_container">
            <?php while ($blogs_query->have_posts()) : ?>
                <?php
                $blogs_query->the_post();
                $blogs_title     = get_the_title();
                $blogs_link      = get_permalink(get_the_ID());
                $blogs_image_url = get_the_post_thumbnail_url(get_the_ID());
                require(get_template_directory() . '/template-parts/components/blogs_archive_template.php');
                ?>
            <?php endwhile; ?>
            <?php wp_reset_query(); ?>
        </div>
        <!-- Numbered Pagination -->
        <div class="pagination mt-8 border-t border-black pt-8 flex justify-center items-center gap-1">
            <?php

            // Prepare SVG icons for previous and next buttons
            $svg_prev = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
              <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
            </svg>';
            $svg_next = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
              <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
            </svg>';


            $total_pages = $blogs_query->max_num_pages;
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

