<?php
$page = get_page_by_path('inspiration-gallery');
acf_add_local_field_group(array(
    'key' => 'gallery_archive_component',
    'title' => 'Gallery Archive',
    'fields' => array(
        array(
            'key' => 'gallery_archive_title',
            'label' => 'Title',
            'name' => 'gallery_archive_title',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'page',
                'operator' => '==',
                'value' => $page->ID,
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
));
?>