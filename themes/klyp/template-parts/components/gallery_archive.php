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
                                  <input class="form-check-input position-absolute" type="checkbox" id="' . $level_2_category->slug . '" value="' . $level_2_category->term_id . '" aria-label="...">
                                  ' . $level_2_category->name . '
                              </label>
                          </div>';
    }
    $level_2_html .= '    </form>
                      </div>';
    $index++;
}
?>

<section class="section-product-list mn-section section-gallery-page py-8 pt-16 sm:py-16 lg:py-24">
    <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto w-full px-8">
        <div class="py-8 border-b border-black flex justify-between items center md:block">
            <h1
                class="text-3xl">
                Inspiration Gallery
            </h1>
            <a href="#" id="open-filters" class="md:hidden flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
                </svg>
                <span class="text-lg">Filters</span>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-12 divide-y md:divide-y-0 md:divide-x divide-black gap-4 md:gap-12">
            <aside id="product-sidebar" class="bg-white z-30 p-8 overflow-auto md:p-0 md:z-0 md:pt-4 fixed inset-0 transition transform-gpu translate-y-full md:translate-y-0 md:self-start md:pt-12 md:col-span-3 md:sticky md:top-24 divide-y divide-black">
                <div class="section-product__sidebar-filter pb-4">
                    <h3 class="text-lg section-product__sidebar-title--filter mb-4">
                        Filter by category
                    </h3>
                    <div class="section-product__sidebar-filter-content">
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
                        <a href="#" class="d-block section-product__sidebar-filter-clear product-filter-clear uppercase">
                            clear all
                        </a>
                    </div>
                </div>
                <div class="divide-y accordion">
                    <?php foreach ($level_1_categories as $level_1_category) :
                        if (in_array($level_1_category->slug, array ('space', 'uncategorized'))) continue ;

                        $level_2_categories = get_terms(array(
                            'taxonomy' => 'product_cat',
                            'child_of' => $level_1_category->term_id,
                        ));

                        //If we have $_GET request, set the accordion to open
                        $show = isset($sanitized_get[$level_1_category->slug]) ? 'show' : '';
                        ?>
                        <div class="py-4 accordion-trigger">
                            <button type="button" id="button-<?= $level_1_category->slug; ?>" class="flex w-full py-2 flex justify-between tracking-wide" data-product-cat="<?= $level_1_category->slug; ?>" aria-controls="filter-<?= $level_1_category->slug; ?>" aria-expanded="false">
                                <?= $level_1_category->name; ?>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                  <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div class="pl-2 pb-4 multi-collapse section-product__sidebar-acc-content <?= $show; ?>"  role="region" aria-labelledby="button-<?= $level_1_category->slug; ?>" id="filter-<?= $level_1_category->slug; ?>" hidden>
                                <form class="section-product__sidebar-form space-y-2">
                                    <?php foreach ($level_2_categories as $level_2_category) : ?>
                                        <?php
                                        //If the value matches $_GET value, mark checkbox as checked
                                        $label_active = '';
                                        $checked = '';

                                        if (isset($sanitized_get[$level_1_category->slug])) {
                                            $single_values = explode(',', $sanitized_get[$level_1_category->slug]);
                                            foreach ($single_values as $single_value) {
                                                if ($single_value == $level_2_category->term_id) {
                                                    $label_active = 'active';
                                                    $checked = 'checked';
                                                }
                                            }
                                        }
                                        ?>
                                        <div class="form-check position-relative product__filter__option cursor-pointer tracking-wide">
                                            <label class="form-check-label flex items-start mn-custom-checkbox <?= $label_active; ?>" for="<?= $level_2_category->slug; ?>">
                                                <input type="checkbox" id="<?= $level_2_category->slug; ?>" class="form-check-input mt-1 mr-3 text-sage" <?= $checked; ?> data-value="<?= $level_2_category->term_id; ?>">
                                                <?= $level_2_category->name; ?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="border-t border-black md:hidden bg-white">
                    <a id="close-filter" href="#" class="flex justify-center items-center text-base py-4">
                        Apply
                    </a>
                </div>
            </aside>
            <div class="md:pl-12 pt-4 md:pt-12 md:col-span-9">
                <div class="flex justify-content-end -ml-8">
                    <div class="section-product-list__masonry section-product-list__masonry--gallery-page gallery-list-container flex-grow-0 flex-shrink-0 basis-full max-w-full">
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
                    <div class="mt-8 text-center section-gallery-list__load-more">
                        <a href="javascript:void(0)" class="mn-btn gallery-load-more uppercase tracking-wide" data-maxpage="<?= ($maxPageNumber); ?>">
                            load more
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>