<?php
//Contents
$section_tile = get_sub_field('product_archive_title');

// Get Woocommerce product categories WP_Term objects
$level_1_categories = get_terms(array(
    'taxonomy' => 'product_cat',
    'parent' => 0
));
//Check if $_GET isset
$sanitized_get = isset($_GET) ? (array) $_GET : array();

//Santize the $_GET values
$sanitized_get = array_map('esc_attr', $sanitized_get);

if (count($sanitized_get) > 0) {
    $cat_query_list = array();
    foreach ($sanitized_get as $key => $value) {
        $single_values = explode(',', $value);
        foreach ($single_values as $single_value) {
            array_push($cat_query_list, $single_value);
        }
    }

    //Get 12 latest products with $_GET query
    $product_query = new WP_Query(array(
        'posts_per_page'        => get_field('products_per_page', 'option'),
        'paged'                 => $paged,
        'post_type'             => 'product',
        'tax_query'             => array(
            array(
                'taxonomy'      => 'product_cat',
                'field'         => 'term_id',
                'terms'         => $cat_query_list,
                'operator'      => 'IN',
            ),
        ),
        'orderby'               => 'title',
        'order'                 => 'asc',
    ));
} else {
    //Get 12 latest products
    $product_query = new WP_Query(array(
        'posts_per_page' => get_field('products_per_page', 'option'),
        'paged'          => $paged,
        'post_type'      => 'product',
        'orderby'        => 'date',
        'order'          => 'desc'
    ));
}

$maxPageNumber = $product_query->max_num_pages;
$currentPageNumber = 1;
$index = 0;
?>

<!--=====================================
=            Product Listing Section            =
======================================-->
<section class="section-product-list py-8 pt-16 sm:py-16 lg:py-24">
    <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto w-full px-8">
        <div class="py-8 border-b border-black flex justify-between items center md:block">
            <h1 class="text-3xl">
                All Products
            </h1>
            <a href="#" id="open-filter" class="md:hidden flex items-center gap-2">
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
                        Browse by category
                    </h3>
                    <div class="section-product__sidebar-filter-content">
                        <ul class="section-product__sidebar-filter-content-list mb-4">
                            <?php if (count($sanitized_get) > 0) : ?>
                                <?php foreach ($_GET as $option => $option_id) : ?>
                                    <?php $single_values = explode(',', $option_id); ?>
                                    <?php foreach ($single_values as $single_value) : ?>
                                        <li class="leading-tight mb-2 section-product__sidebar-filter-content-list-item list-inline-item fo_<?= $single_value; ?>" data-selected-cat="<?= $single_value; ?>">
                                            <a href="javascript:void(0);" class="flex items-center product-remove-cat group" data-id="<?= $single_value; ?>" >
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 flex-shrink-0 group-hover:text-sage transition">
                                                  <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                                </svg>
                                                <span><?= get_the_category_by_ID($single_value); ?></span>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
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
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 product-list-container gap-4 md:gap-12">
                    <!-- <?php $i = 0; ?>
                    <?php while ($product_query->have_posts()) : ?>
                        <?php
                        $product_query->the_post();
                        $product_title     = get_the_title();
                        $product_link      = get_permalink(get_the_ID());
                        $product_image_url = get_the_post_thumbnail_url(get_the_ID());
                        require(get_template_directory() . '/template-parts/components/product_archive_template.php');
                        $i++;
                        ?>
                    <?php endwhile; ?>
                    <?php wp_reset_query(); ?> -->
                </div>
                <div class="section-product-list__load-more">
                    <div class="mt-8 text-center">
                        <a href="#" class="product-load-more uppercase tracking-wide" data-maxpage="<?= ($maxPageNumber); ?>">
                            Load More
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!--====  End of Product Listing Section  ====-->