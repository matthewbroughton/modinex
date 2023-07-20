<?php

/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action('woocommerce_before_single_product');

global $product, $woocommerce;

if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
//List of section to be listed in bottom navigation bar
$has_section = array();
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>
    <?php
    //Hero Section
    require('single-product/hero.php');
    ?>
    <section id="technical-info">
        <div class="border-x border-black mx-4 sm:mx-6 py-8 sm:py-16">
            <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto w-full px-8">
                <div class="flex flex-col gap-4 pb-6 sm:pb-12 border-b border-black mb-12">
                    <h2 class="text-3xl">
                        <?= get_the_title(); ?>
                    </h2>
                    <div class="lg:max-w-screen-md">
                        <?= $product->get_description(); ?>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="section-des__sidebar">
                        <div class="sticky md:top-24 md:pt-12">
                            <div class="section-des__sidebar-img lg:max-w-md" data-default-img="<?= get_the_post_thumbnail_url(get_the_ID()); ?>">
                                <img src="<?= get_the_post_thumbnail_url(get_the_ID()); ?>" alt="" class="img-fluid">
                            </div>
                            <h3 class="section-des__sidebar-title text-center hidden">
                                From <span class="product_price" data-original-price="<?= $product->get_price(); ?>"><span class="price_symbol"><?= get_woocommerce_currency_symbol(); ?></span><span class="price_amount"><?= $product->get_price(); ?></span> per <?= get_field('uom'); ?>
                            </h3>
                            <dl class="divide-y divide-gray-100 selected_options">
                            </dl>
                            <?php if (get_field('email_me_specs_shortcode', 'option') != '') : ?>
                                <a href="#" class="section-project-bottom-nav__btn-form emailSpecs-form btn--hide text-black border-black rounded-full border py-2 px-4" data-btn="emailSpecs-form">
                                    Email Me Specs
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="flex flex-col gap-12">
                        <?php require('single-product/product_options.php'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php

    //Gallery Section
    require('single-product/gallery.php');

    //Horizontal Column Section
    require('single-product/horizontal_columns.php');

    //How It Works Section
    require('single-product/how_it_works.php');

    //Features and Benefits Section
    require('single-product/features_benefits.php');

    //Downloads Section
    require('single-product/downloads.php');

    //Size and Specifications Section
    require('single-product/size_specifications.php');

    //Client Review Section
    require('single-product/client_reviews.php');

    //Similar Projects Section
    require('single-product/product_similar_project_settings.php');

    //Sliding forms
    require('single-product/slide_forms.php');
    ?>

</div>

<?php do_action('woocommerce_after_single_product'); ?>