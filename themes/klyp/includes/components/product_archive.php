<?php
$page = get_page_by_path('products');
acf_add_local_field_group(array(
    'key' => 'product_archive_component',
    'title' => 'Product Archive',
    'fields' => array(
        array(
            'key' => 'product_archive_title',
            'label' => 'Title',
            'name' => 'product_archive_title',
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