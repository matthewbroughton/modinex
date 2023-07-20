<?php

    $section_show           = get_field('projects_feature_call_to_action_supply_and_install')['enable_component'];
    $section_id             = get_field('projects_feature_call_to_action_supply_and_install')['id'];
    $section_class          = get_field('projects_feature_call_to_action_supply_and_install')['class'];
    $section_layout         = get_field('projects_feature_call_to_action_supply_and_install')['fh_layout_type'];
    $layout_class           = $section_layout == 'left' ? 'sm:order-last' : '';
    $divide_reverse         = $section_layout == 'left' ? 'sm:divide-x-reverse' : '';

        //Contents
    $feature_tile           = get_field('projects_feature_call_to_action_supply_and_install')['title'];
    $feature_image_url      = get_field('projects_feature_call_to_action_supply_and_install')['feature_image'];
    $feature_video_enabled  = get_field('projects_feature_call_to_action_supply_and_install')['enable_video'];
    $feature_video_url      = get_field('projects_feature_call_to_action_supply_and_install')['video_url'];
    $feature_layout_type    = get_field('projects_feature_call_to_action_supply_and_install')['fh_layout_type'];
    $feature_description    = get_field('projects_feature_call_to_action_supply_and_install')['feature_description'];
    $feature_cta_enabled    = get_field('projects_feature_call_to_action_supply_and_install')['enable_cta'];
    $feature_cta_url        = get_field('projects_feature_call_to_action_supply_and_install')['cta_url'];

    require(get_template_directory().'/template-parts/components/projects/feature_call_to_action_template.php');
?>
