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

$catPage = is_product_category();
if ($catPage) {
    $catObj        = $wp_query->get_queried_object();
    $catName       = $wp_query->get_queried_object()->name;
    $product_query = new WP_Query(array(
        'posts_per_page'        => get_field('products_per_page', 'option'),
        'paged'                 => 1,
        'post_type'             => 'project',
        'tax_query'             => array(
            array(
                'taxonomy'      => 'product_cat',
                'field'         => 'term_id',
                'terms'         => $wp_query->get_queried_object()->term_id,
                'operator'      => 'IN',
            ),
        ),
        'orderby'               => 'title',
        'order'                 => 'asc',
    ));
    $productsPageLink = get_field('products_page_link', 'option');
} else {
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
            'paged'                 => 1,
            'post_type'             => 'project',
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
            'paged'          => 1,
            'post_type'      => 'project',
            'orderby'        => 'title',
            'order'          => 'asc'
        ));
    }
}
$total_products = count( get_posts( array('post_type' => 'product', 'post_status' => 'publish', 'fields' => 'ids', 'posts_per_page' => '-1') ) );
$prodMax = $total_products / get_field('products_per_page', 'option');


$maxPageNumber = $product_query->max_num_pages;
$currentPageNumber = 1;
$index = 0;

$bannerImage    = get_field('product_cat_banner_image');
$bannerTitle    = get_field('product_cat_banner_title');
$bannerSubTitle = get_field('product_cat_banner_sub_title');
$contentTitle   = get_field('product_cat_content_title');
$contentDesc    = get_field('product_cat_content_description');

$bannerFlag = false;
if (! empty($bannerImage) && ! empty($bannerTitle) && ! empty($bannerSubTitle)) {
    $bannerFlag = true;
}
?>

<!--=====================================
=            Product Listing Section            =
======================================-->

<?php if ($bannerFlag) : ?>
    <section id="" class="relative overflow-hidden min-h-[24rem] lg:min-h-[36rem] flex items-center -mb-px product-cat__banner">
        <?php
        if ($bannerImage) {
        ?>
            <div class="bg-black opacity-50 absolute inset-0 z-0"></div>
            <img src="<?php echo $bannerImage; ?>" alt="" class="absolute inset-0 -z-10 h-full w-full object-cover">
        <?php } ?>
        <div class="z-10 mx-auto max-w-screen-lg xl:max-w-screen-xl w-full mt-4">
            <div class="w-full max-w-screen-lg lg:max-w-screen-md flex flex-col px-6 sm:px-12">
                <div class="max-w-screen-sm">
                    <?php if ($bannerFlag) : ?>
                        <h1 class="text-3xl lg:text-4xl mb-2 text-white font-light">
                            <?php echo $bannerTitle; ?>
                        </h1>
                        <div class="text-base lg:max-w-screen-md text-white font-light">
                            <?php echo $bannerSubTitle; ?>
                        </div>
                    <?php else : ?>
                        <h1 class="text-3xl lg:text-4xl">
                            <?php echo (! $bannerFlag) ? (($catPage) ? $catName : 'All Products') : ''; ?>
                        </h1>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<section class="section-product-list py-8 sm:py-16 lg:py-24">
    <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto w-full px-8">
        <?php if (!$bannerFlag) : ?>
            <div class="py-8 border-b border-black flex justify-between items center md:block">
                <h2 class="text-3xl lg:text-4xl">
                    <?php echo (! $bannerFlag) ? (($catPage) ? $catName : 'All Products') : ''; ?>
                </h2>
                    <a href="#" id="open-filter" class="md:hidden flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
                        </svg>
                        <span class="text-lg">Filters</span>
                    </a>
            </div>
        <?php endif; ?>
        <div class="grid grid-cols-1 md:grid-cols-12 divide-y md:divide-y-0 md:divide-x divide-black gap-4 md:gap-12">
            <aside id="product-sidebar" class="bg-white z-30 md:z-0 p-8 overflow-auto md:p-0 md:pt-4 fixed inset-0 transition transform-gpu translate-y-full md:translate-y-0 md:self-start md:pt-12 md:col-span-3 md:sticky md:top-24 divide-y divide-black">
                <div class="section-product__sidebar-filter pb-4">
                    <h3 class="text-lg section-product__sidebar-title--filter mb-4">
                        Browse by category
                    </h3>
                    <input type="hidden" id="products_page_link" value="<?php echo $productsPageLink; ?>">
                    <div class="section-product__sidebar-filter-content">
                        <ul class="section-product__sidebar-filter-content-list mb-4">
                            <?php if (count($sanitized_get) > 0) : ?>
                                <?php foreach ($_GET as $option => $option_id) : ?>
                                    <?php $single_values = explode(',', $option_id); ?>
                                    <?php foreach ($single_values as $single_value) : ?>
                                        <li class="leading-tight mb-2 section-product__sidebar-filter-content-list-item list-inline-item fo_<?= $single_value; ?>" data-selected-cat="<?= $single_value; ?>">
                                            <a href="#<?= $single_value; ?>" class="flex items-start gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 flex-shrink-0">
                                                  <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                                </svg>
                                                <span><?= get_the_category_by_ID($single_value); ?></span>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <?php if ($catPage) : ?>
                                <li class="leading-tight mb-2 section-product__sidebar-filter-content-list-item list-inline-item fo_<?= $catObj->term_id; ?>" data-selected-cat="<?= $catObj->term_id; ?>">
                                    <a href="#<?= $catObj->term_id; ?>" class="flex items-start gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 flex-shrink-0">
                                          <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                        </svg>
                                        <span><?= $catName ?></span>
                                    </a>
                                </li>
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
                        $show = '';
                        if ( ! empty($sanitized_get)) {
                            $show = isset($sanitized_get[$level_1_category->slug]) ? 'show' : '';
                        } else {
                            if ($wp_query->get_queried_object()->parent > 0) {
                                $term = get_term($wp_query->get_queried_object()->parent, 'product_cat');
                                $show = ($term->slug == $level_1_category->slug) ? 'show' : '';
                            }
                        }
                        ?>
                        <div class="py-4 accordion-trigger">
                            <button type="button" id="button-<?= $level_1_category->slug; ?>" class="flex w-full py-2 flex justify-between" data-product-cat="<?= $level_1_category->slug; ?>" aria-controls="filter-<?= $level_1_category->slug; ?>" aria-expanded="false">
                                <?= $level_1_category->name; ?>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                  <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div class="pl-2 pb-4 multi-collapse section-product__sidebar-acc-content <?= $show; ?>" role="region" aria-labelledby="button-<?= $level_1_category->slug; ?>" id="filter-<?= $level_1_category->slug; ?>" hidden>
                                <form class="section-product__sidebar-form space-y-2">
                                    <?php foreach ($level_2_categories as $level_2_category) : ?>
                                        <?php
                                        //If the value matches $_GET value, mark checkbox as checked
                                        $label_active = '';
                                        $checked = '';
                                        if ($catPage) {
                                            if ($wp_query->get_queried_object()->term_id  == $level_2_category->term_id) {
                                                $label_active = 'active';
                                                $checked = 'checked';
                                            }
                                        } else {
                                            if (isset($sanitized_get[$level_1_category->slug])) {
                                                $single_values = explode(',', $sanitized_get[$level_1_category->slug]);
                                                foreach ($single_values as $single_value) {
                                                    if ($single_value == $level_2_category->term_id) {
                                                        $label_active = 'active';
                                                        $checked = 'checked';
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                        <div class="form-check position-relative product__filter__option cursor-pointer">
                                            <label class="form-check-label flex items-start mn-custom-checkbox <?= $label_active; ?>" for="<?= $level_2_category->slug; ?>">
                                                <input type="checkbox" id="<?= $level_2_category->slug; ?>" class="form-check-input text-sage mt-1 mr-3" <?= $checked; ?> data-value="<?= $level_2_category->term_id; ?>">
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
            <div class="md:pl-12 md:col-span-9 <?php echo (! $bannerFlag) ? 'pt-4 md:pt-12' : ''; ?>">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 product-list-container gap-4 md:gap-12">
                    <?php $i = 0; ?>
                    <?php $paged = 1; ?>
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
                    <?php wp_reset_query(); ?>
                </div>
                <div class="section-product-list__load-more" style="<?php echo ($currentPageNumber == $maxPageNumber) ? 'display:none;' : '' ; ?>">
                    <div class="mt-8 text-center">
                        <a href="#" class="product-load-more uppercase tracking-wide" data-maxpage="<?= ($maxPageNumber); ?>">
                            load more
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="divide-y divide-black">
<?php if( have_rows('components') ){
    while ( have_rows('components') ) {
        the_row();
        $layout_name = get_row_layout();
        get_template_part('template-parts/components/' . $layout_name);
    }
} ?>
</div>
<!--====  End of Product Listing Section  ====-->

<!-- Alpha Form Popup -->
<style>
body.no-scroll{overflow:hidden!important}.section-br-banner__content{bottom:-60px!important}.alphadigital-cat-form-popup,.alphadigital-cat-form-popup-overlay{bottom:0;opacity:0;pointer-events:none;position:fixed;right:0;top:0}.alphadigital-cat-form-popup{padding:4.5rem 3rem;background:#fff;-webkit-box-shadow:-8px 0 26px 0 rgba(115,145,169,.12);box-shadow:-8px 0 26px 0 rgba(115,145,169,.12);height:100vh;max-width:656px;overflow-y:auto;-webkit-transition:-webkit-transform .3s ease-in-out;-o-transition:transform .3s ease-in-out;transition:transform .3s ease-in-out;transition:transform .3s ease-in-out,-webkit-transform .3s ease-in-out;-webkit-transition-delay:.5s;-o-transition-delay:.5s;transition-delay:.5s;-webkit-transform:translate3d(100%,0,0);transform:translate3d(100%,0,0);width:100%;z-index:-1}.alphadigital-cat-form-popup-overlay{background-color:hsla(0deg,0%,100%,.9);left:0;-webkit-transition:opacity .5s ease-in-out;-o-transition:opacity .5s ease-in-out;transition:opacity .5s ease-in-out;z-index:5554;border:0;cursor:pointer}.alphadigital-cat-form-popup-overlay.form-active{opacity:1;z-index:5554;pointer-events:all;-webkit-transition-delay:0s;-o-transition-delay:0s;transition-delay:0s}.alphadigital-cat-form-popup__close{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:end;-webkit-justify-content:flex-end;-ms-flex-pack:end;justify-content:flex-end}.alphadigital-cat-form-popup__close a,.alphadigital-cat-form-popup__close button{position:relative;display:inline-block;height:32px;width:32px}.alphadigital-cat-form-popup__close a::before,.alphadigital-cat-form-popup__close button::before{border-bottom:2px solid #162131;top:50%;-webkit-transform:rotate(-45deg) translateY(-1px);-ms-transform:rotate(-45deg) translateY(-1px);transform:rotate(-45deg) translateY(-1px)}.alphadigital-cat-form-popup__close a::after,.alphadigital-cat-form-popup__close button::after{border-bottom:2px solid rgba(47,59,76,.5);top:50%;-webkit-transform:rotate(45deg) translateY(-1px);-ms-transform:rotate(45deg) translateY(-1px);transform:rotate(45deg) translateY(-1px)}.alphadigital-cat-form-popup__close a::after,.alphadigital-cat-form-popup__close a::before,.alphadigital-cat-form-popup__close button::after,.alphadigital-cat-form-popup__close button::before{content:"";width:32px;position:absolute;left:0;-webkit-transition:all 1s linear;-o-transition:all 1s linear;transition:all 1s linear}.alphadigital-cat-form-popup__heading .heading{color:#162131}.alphadigital-cat-form-popup.form-active{-webkit-transform:translate3d(0,0,0);transform:translate3d(0,0,0);-webkit-transition:-webkit-transform .5s ease-in-out;-o-transition:transform .5s ease-in-out;transition:transform .5s ease-in-out;transition:transform .5s ease-in-out,-webkit-transform .5s ease-in-out;opacity:1;z-index:5555;pointer-events:auto}
</style>

<script>
    var productCategoryPageTitle = jQuery(".section-br-banner__title").text().trim();

    jQuery(
        ".alphadigital-cat-form-popup .alphadigital-cat-form-popup__form .productCategoryPage input"
    ).val(productCategoryPageTitle);

    jQuery(
        ".alphadigital-cat-form-popup .alphadigital-cat-form-popup__form .productCategoryURL input"
    ).val(document.location.href);
</script>

<!-- Product Category Popup -->
<button class="alphadigital-cat-form-popup-overlay js-ad-popup-form-close"></button>

<div class="alphadigital-cat-form-popup">
    <div class="alphadigital-cat-form-popup__close">
        <a href="javascript:void(0)" class="js-ad-popup-form-close"></a>
    </div>
    <div class="alphadigital-cat-form-popup__heading">
        <span class="d-block heading h2">Request a Quote</span>
    </div>
    <div class="alphadigital-cat-form-popup__form">
        <div>
            <?php echo do_shortcode('[contact-form-7 id="20813" title="Request a category quote - Alt"]'); ?>
        </div>
    </div>
</div>
<!-- Product Category Popup - END -->