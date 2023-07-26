<?php

$post_type = get_post_type();
//Settings
$sectionShow           = get_sub_field('component_all_projects_lists_component_enabled');
$sectionId             = get_sub_field('component_all_projects_lists_field_id');
$sectionClass          = get_sub_field('component_all_projects_lists_field_class');

//Contents
$featureTitle           = get_sub_field('component_all_projects_list_title');
$taxonomy = get_sub_field('component_all_projects_list_category');

// Get project categories - top level
$level1Categories = get_terms(array(
    'taxonomy' => 'project_category',
    'parent' => 0,
));

//Get 12 latest projects
global $wp_query;
$query = new WP_Query(array(
    'posts_per_page' => get_field('projects_per_page', 'option'),
    'post_status' => 'publish',
    'post_type' => 'project',
    'tax_query'             => array(
        array(
            'taxonomy'      => 'project_category',
            'field'         => 'term_id',
            'terms'         => $taxonomy,
            'operator'      => 'IN',
        ),
    ),
    'orderby' => 'post_date',
    'order' => 'desc'
));
$maxPageNumber = $query->max_num_pages;
$currentPageNumber = 1;
$index = 0;
?>
<?php if ($sectionShow == true) : ?>
    <section id="<?= $sectionId ?>" class="section-product-list border-x border-black mx-4 sm:mx-6 py-16 sm:py-24 lg:py-36 <?= $sectionClass ?>">
        <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto w-full px-8">
            <div class="flex flex-col-reverse lg:flex-row gap-4 items-center">
                <h2 class="text-3xl lg:text-4xl">
                    <?= $featureTitle ?>
                </h2>
                <h3><?php print_r($taxonomy); ?></h3>
            </div>
            <hr class="border-t w-full my-8 border-black">
            <?php
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
            ?>
            <div class="flex justify-content-end -ml-8">
                <div class="section-product-list__masonry flex-grow-0 flex-shrink-0 basis-full max-w-full project-posts-container" data-url="<?php echo admin_url('admin-ajax.php') ?>">
                </div>
            </div>
            <?php if ($maxPageNumber > $currentPageNumber) : ?>
                <div class="mt-8 text-center section-project-list__load-more load-more-container">
                    <a href="javascript:void(0)" class="mn-btn project-load-more uppercase tracking-wide" data-maxpage="<?= ($maxPageNumber); ?>">
                        load more
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>