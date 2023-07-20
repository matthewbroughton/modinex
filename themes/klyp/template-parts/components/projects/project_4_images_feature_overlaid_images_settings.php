<?php
//Settings
$section_show = get_field('projects_overlaid_images_4')['enable_component'];
$section_id = get_field('projects_overlaid_images_4')['id'];
$section_class = get_field('projects_overlaid_images_4')['class'];
$section_layout = get_field('projects_overlaid_images_4')['overlaid_switch'];

$feature_image1 = get_field('projects_overlaid_images_4')['image1'];
$feature_image2 = get_field('projects_overlaid_images_4')['image2'];
$feature_image3 = get_field('projects_overlaid_images_4')['image3'];
$feature_image4 = get_field('projects_overlaid_images_4')['image4'];

if ($section_layout == false) {
    $feature_image5 = get_field('projects_overlaid_images_4')['image5'];
}

require(get_template_directory() . '/template-parts/components/projects/feature_overlaid_images_template.php');
?>