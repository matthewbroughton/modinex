<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Klyp
 */

get_header();
// Remove the horizontal dividers for the history page specifically
$class = (!is_page('history')) ? 'divide-y divide-black' : '';
?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main <?= $class ?>">

        <?php
            if ( have_posts() && !is_product_category()) :
                while ( have_posts() ) : the_post();
                    if( have_rows('components') ){
                        while ( have_rows('components') ) {
                            the_row();
                            $layout_name = get_row_layout();
                            get_template_part('template-parts/components/' . $layout_name);
                        }
                    }
                endwhile;
            endif;
            if (is_page('products')) {
                get_template_part('template-parts/components/product_archive');
            }
            if (is_product_category()) {
                get_template_part('woocommerce/taxonomy-product_cat');
            }
            if (is_page('blogs')) {
                get_template_part('template-parts/components/blogs_archive');
            }
            if (is_page('resellers')) {
                get_template_part('template-parts/components/resellers');
            }
            if (is_page('inspiration-gallery')) {
                get_template_part('template-parts/components/gallery_archive');
            }
            if (is_page('product-information-hub')) {
                get_template_part('template-parts/components/product-information-hub');
            }
            if (is_page('history')) {
                get_template_part('template-parts/components/history');
            }
        ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_sidebar();
get_footer();
