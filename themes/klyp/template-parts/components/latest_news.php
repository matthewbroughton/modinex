<?php
    $post_type = get_post_type();
    //Settings
    $section_show           = get_sub_field('component_latest_news_component_enabled');
    $section_id             = get_sub_field('component_latest_news_field_id');
    $section_class          = get_sub_field('component_latest_news_field_class');
    $section_layout         = get_sub_field('component_latest_news_layout_type');
    $image_layout           = get_sub_field('component_latest_news_image_ratio');

    if ($image_layout == '1:1') {
        $image_ratio = 'aspect-w-1 aspect-h-1';
    } elseif ($image_layout == '16:9') {
        $image_ratio = 'aspect-w-16 aspect-h-9';
    } elseif ($image_layout == '4:3') {
        $image_ratio = 'aspect-w-4 aspect-h-3';
    } elseif ($image_layout == '3:4') {
        $image_ratio = 'aspect-w-3 aspect-h-4';
    } elseif ($image_layout == '9:16') {
        $image_ratio = 'aspect-w-9 aspect-h-16';
    } else {
        $image_ratio = '';
    }

    //Contents
    $section_tile           = get_sub_field('component_latest_news_title');
    $section_description    = get_sub_field('component_latest_news_feature_description');

    $post_title = array();
    $post_link = array();
    $post_image_url = array();

    //Get featured post
    $featured_post = get_sub_field('component_latest_news_featured_post');
    $featured_video_url = get_sub_field('component_latest_news_video_url');

    //Get 3 latest posts (not in Featured Posts category)
    $featured_post_category = get_category_by_slug('featured-posts');
    $query = new WP_Query(array(
        'orderby'           => 'date',
        'order'             => 'DESC',
        'post_type'         => 'post',
        'posts_per_page'    => 3,
        'category__not_in'  => array($featured_post_category->term_id),
    ));

    $index = 0;
?>
<?php if ($section_show == true) : ?>
    <section id="<?= $section_id; ?>" class="<?= $section_class; ?> border-x border-black mx-4 sm:mx-6 py-16 sm:py-24 lg:py-36">
        <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto w-full px-8 flex flex-col gap-4">
            <?php if($section_tile) : ?>
            <div class="mb-4">
                <h3 class="text-3xl lg:text-4xl"><?= $section_tile; ?></h3>
                <?php if ($section_description) : ?>
                <?= $section_description; ?>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <div class="grid grid-cols-1 md:grid-cols-3 divide-y md:divide-y-0 md:divide-x divide-black gap-8 md:-ml-8">
                <?php
                    while ($query->have_posts()) :
                        $query->the_post();
                        $post_title[$index]     = get_the_title();
                        $post_link[$index]      = get_permalink(get_the_ID());
                        $post_image_url[$index] = get_the_post_thumbnail_url(get_the_ID());
                        $post_category[$index]  = get_the_category_list(get_the_ID());
                ?>
                    <div class="flex flex-col gap-4 pt-8 md:pt-0 md:pl-8">
                        <a href="<?= $post_link[$index] ?>" class="block">
                            <div class="<?= $image_ratio; ?>">
                                <img src="<?= $post_image_url[$index]; ?>" alt="" class="w-full h-full object-cover">
                            </div>
                        </a>
                        <div class="flex flex-col gap-1">
                            <div class="text-sm text-gray-400">
                                <?= $post_category[$index] ?>
                            </div>
                            <a href="<?= $post_link[$index] ?>" class="flex justify-between items-start gap-4">
                                <h3 class="text-lg"><?= $post_title[$index]; ?></h3>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 flex-shrink-0">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                <?php
                    $index++;
                    endwhile;
                    wp_reset_query();
                ?>
            </div>
        </div>
    </section>
<?php endif; ?>
