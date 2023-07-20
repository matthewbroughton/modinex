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
<main class="divide-y divide-black">
<?php if (have_posts()) :

    /* Start the Loop */
    while (have_posts()) :
        the_post();
        //Display project page section
        get_template_part('template-parts/components/page_hero');
        get_template_part('template-parts/components/home_introduction');
        get_template_part('template-parts/components/projects/project_summary_feature_call_to_action_settings');
        get_template_part('template-parts/components/projects/project_4_images_feature_overlaid_images_settings');
        get_template_part('template-parts/components/projects/project_our_solution_feature_call_to_action_settings');
        get_template_part('template-parts/components/projects/project_supply_and_install_feature_call_to_action_settings');
        get_template_part('template-parts/components/projects/project_5_images_feature_overlaid_images_settings');
        get_template_part('template-parts/components/projects/project_mini_projects_lists_settings');
    endwhile;
endif; ?>
</main>
<?php
    get_footer();
?>