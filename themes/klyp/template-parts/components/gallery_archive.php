<?php
//Contents
//Get 30 latest galleries
$gallery_query = new WP_Query(array(
    'posts_per_page' => get_field('gallery_image_per_page', 'option'),
    'post_type' => 'gallery',
    'orderby' => 'post_date',
    'order' => 'desc'
));

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

<section class="section-product-list mn-section section-gallery-page">
    <div class="section-gallery-page__gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1
                        class="mn-title--big text-center section-product-list__heading--gallery section-product-list__heading">
                        Inspiration Gallery
                    </h1>
                </div>
                <div class="col-12">
                    <div class="section-gallery-page__tab">
                        <ul class="nav nav-tabs justify-content-center">
                            <?= $level_1_html; ?>
                            <li class='nav-item gallery__tab-clearall'>
                                <a href="#" class="d-block section-product__sidebar-filter-clear gallery-filter-clear text-uppercase">
                                    clear all
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <?= $level_2_html; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row align-items-start">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 d-flex justify-content-end">
                        <div class="section-product-list__masonry section-product-list__masonry--gallery-page gallery-list-container">
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
                    <?php if ($maxPageNumber != $currentPageNumber) : ?>
                        <div class="col-12 text-center section-gallery-list__load-more">
                            <a href="javascript:void(0)" class="mn-btn gallery-load-more" data-maxpage="<?= ($maxPageNumber); ?>">
                                load more
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>