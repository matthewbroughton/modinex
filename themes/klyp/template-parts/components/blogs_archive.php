<?php
//Contents
$section_tile = get_sub_field('blogs_archive_title');

//Get 12 latest blogs
$blogs_query = new WP_Query(array(
    'posts_per_page' => get_field('blog_post_per_page', 'option'),
    'post_type' => 'post',
    'orderby' => 'post_date',
    'order' => 'desc'
));
$maxPageNumber = $blogs_query->max_num_pages;
$currentPageNumber = 1;
$index = 0;
?>

<section class="border-x border-black mx-4 sm:mx-6 py-16 sm:py-24 lg:py-36">
    <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto w-full px-8">
            <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-8 xl:gap-12 blog_posts_container">
                <?php while ($blogs_query->have_posts()): ?>
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
    </div>
</section>