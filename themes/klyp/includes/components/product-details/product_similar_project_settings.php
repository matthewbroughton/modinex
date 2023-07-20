<?php
//Settings
$section_show = get_field('product_mini_projects_lists')['enable_component'];
$section_id = get_field('product_mini_projects_lists')['id'];
$section_class = get_field('product_mini_projects_lists')['class'];
$section_layout = get_field('product_mini_projects_lists')['component_mini_projects_lists_layout_switch'];

$feature_project_image_url = array();
$feature_project_image_title = array();
$feature_project_image_description = array();

//true means using default layout( showing the latest 4 projects)
if ($section_layout) {
    $feature_projects_list = new WP_Query(array(
        'posts_per_page' => 4,
        'post_type' => 'project',
        'orderby' => 'post_date',
        'order' => 'desc'
    ));

    while ($feature_projects_list->have_posts()) {
        $feature_projects_list->the_post();
        array_push($feature_project_image_url, get_the_post_thumbnail_url(get_the_ID()));
        array_push($feature_project_image_title, get_the_title(get_the_ID()));
        array_push($feature_project_image_description, get_the_content(get_the_ID()));
    }
} else {
    $feature_projects_list = get_field('product_mini_projects_lists')['component_mini_projects_lists'];
    for ($i = 0; $i < count($feature_projects_list); $i++) {
        $id = $feature_projects_list[$i]['project']->ID;
        array_push($feature_project_image_url, get_the_post_thumbnail_url($id));
        array_push($feature_project_image_title, get_the_title($id));
        array_push($feature_project_image_description, get_the_content($id));
    }
}

require(get_template_directory() . '/template-parts/components/feature_mini_projects_lists_template.php');
?>

