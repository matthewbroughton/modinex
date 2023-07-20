<?php
//Contents
//Get 30 latest galleries
$gallery_query = new WP_Query(array(
    'posts_per_page' => get_field('gallery_image_per_page', 'option'),
    'post_type' => 'gallery',
    'orderby' => 'post_date',
    'order' => 'desc'
));

$section_id           = get_sub_field('component_inspiration_gallery_field_id');
$section_class        = get_sub_field('component_inspiration_gallery_field_class');
$galleryTitle = get_sub_field('inspiration_gallery_title');
$maxPageNumber = $gallery_query->max_num_pages;
$currentPageNumber = 1;
$index = 0;

//Get Top level filter
$level_1_categories = get_terms(array(
    'taxonomy' => 'gallery_category',
    'parent' => 0,
    'order' => 'desc'
));

$level_1_html = '';
$level_2_html = '';
$index = 0;
foreach ($level_1_categories as $level_1_category) {

    $active = $index == 0 ? 'active show' : '';
    $level_2_categories = get_terms(array(
        'taxonomy' => 'gallery_category',
        'child_of' => $level_1_category->term_id,
    ));

    $level_1_html .= '<li class="nav-item">
                          <a class="nav-link ' . $active . '" data-toggle="tab" href="#' . $level_1_category->slug . '-gallery">' . $level_1_category->name . '</a>
                      </li>';

    $level_2_html .= '<div id="' . $level_1_category->slug . '-gallery" class="tab-pane fade position-relative ' . $active . '">
                          <form class="section-gallery-page__form">';

    foreach ($level_2_categories as $level_2_category) {
        $level_2_html .= '<div class="section-gallery-page__form-check form-check position-relative">
                              <label class="form-check-label d-block mn-custom-checkbox" for="' . $level_2_category->slug . '">
                                  ' . $level_2_category->name . '
                                  <input class="form-check-input position-absolute" type="checkbox" id="' . $level_2_category->slug . '" value="' . $level_2_category->term_id . '" aria-label="...">
                                  <span class="mn-checkmark"></span>
                              </label>
                          </div>';
    }
    $level_2_html .= '    </form>
                      </div>';
    $index++;
}
?>

<section id="<?= $section_id ?>" class="section-product-list section-gallery-page border-x border-black mx-4 sm:mx-6 py-16 sm:py-24 lg:py-36 <?= $section_class ?>">
    <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto w-full px-8">
        <div class="flex flex-col-reverse lg:flex-row gap-4 items-center">
            <h2 class="text-3xl lg:text-4xl">
                <?= $galleryTitle ?>
            </h2>
        </div>
        <hr class="border-t w-full my-8 border-black">
        <div class="flex justify-content-end">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                <?php
                while ($gallery_query->have_posts()) {
                    $gallery_query->the_post();
                    $gallery_title     = get_the_title();
                    $gallery_link      = get_field('inspiration_gallery_link', get_the_ID());
                    $gallery_link      = empty($gallery_link) ? 'javascript:void(0);' : $gallery_link['url'];
                    $gallery_image_url = get_field('inspiration_gallery_image', get_the_ID());
                    require(get_template_directory() . '/template-parts/components/gallery_archive_template.php');
                }
                wp_reset_query();
                ?>
            </div>
        </div>
    </div>
</section>