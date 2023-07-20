<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Klyp
 */

get_header();
?>

    <div id="primary" class="content-area blog_post_content">
        <main id="main" class="site-main">

        <?php
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
                    if( have_rows('components') ){
                        while ( have_rows('components') ) {
                            the_row();
                            $layout_name = get_row_layout();
                            get_template_part('template-parts/components/' . $layout_name);
                        }
                    } else {
                        get_template_part('template-parts/content', get_post_type());
                    }
                endwhile;
            endif;
        ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_sidebar();
get_footer();
