<?php
// acf functions to create the components fields
acf_add_local_field_group(
    array(
        'key' => 'klyp_group_components',
        'title' => 'Components',
        'fields' => array(
            array(
                'key' => 'field_klyp_components',
                'label' => '',
                'name' => 'components',
                'type' => 'flexible_content',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'layouts' => $component_fields,
                'button_label' => 'Add Component',
                'min' => '',
                'max' => '',
            )
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page'
                ),
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'default'
                ),
            ),
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page'
                ),
            ),
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'post',
                ),
            ),
        ),
        'menu_order' => '',
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => array(
            0 => 'the_content',
            1 => 'excerpt',
            2 => 'discussion',
            3 => 'comments',
            4 => 'revisions',
            5 => 'format',
            6 => 'categories',
            7 => 'tags',
            8 => 'send-trackbacks',
        ),
        'active' => 1,
        'description' => '',
    )
);

require_once('product_details_components.php');
require_once('projects_components.php');
require_once('product_archive.php');
require_once('post_attributes.php');
require_once('blogs_archive.php');
require_once('resellers.php');
require_once('reseller_location_components.php');
require_once('gallery_archive.php');
require_once('gallery_components.php');
require_once('history.php');