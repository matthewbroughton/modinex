<?php
$fields = array(
    'component_home_hero' => array(
        'key' => 'component_home_hero',
        'name' => 'home_hero',
        'label' => 'Hero Section (Home)',
        'display' => 'block',
        'sub_fields' => array(
            //Component Settings Tab
            array(
                'key' => 'component_home_hero_tab_setting',
                'label' => 'Settings',
                'name' => '',
                'type' => 'tab',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placement' => 'top',
                'endpoint' => 0,
            ),
            array(
                'key' => 'component_home_hero_component_enabled',
                'label' => 'Show This Component?',
                'name' => 'enable_mobile',
                'type' => 'true_false',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => '',
                'default_value' => 1,
                'ui' => 1,
                'ui_on_text' => 'Enabled',
                'ui_off_text' => 'Hidden',
            ),
            array(
                'key' => 'component_home_hero_field_id',
                'label' => 'ID',
                'name' => 'id',
                'type' => 'text',
                'instructions' => 'identifier',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
            ),
            array(
                'key' => 'component_home_hero_field_class',
                'label' => 'Classes',
                'name' => 'class',
                'type' => 'text',
                'instructions' => 'additional classes',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
            ),

            // Component Content Tab
            array(
                'key' => 'component_home_hero_tab_content',
                'label' => 'Content',
                'name' => '',
                'type' => 'tab',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'component_home_hero_component_enabled',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placement' => 'top',
                'endpoint' => 0,
            ),
            array(
                'key' => 'component_home_hero_heading',
                'label' => 'Heading',
                'name' => 'home_hero_heading',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
            ),
            array(
                'key' => 'component_home_hero_layout',
                'label' => 'Layout Type',
                'name' => 'hero_layout_type',
                'type' => 'radio',
                'instructions' => 'This will determine the number of columns on large tablets and desktops',
                'required' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array(
                    'three' => 'Three Columns',
                    'four' => 'Four Columns',
                ),
                'allow_null' => 0,
                'other_choice' => 0,
                'save_other_choice' => 0,
                'default_value' => '',
                'layout' => 'horizontal',
                'return_format' => 'value',
            ),
            array(
                'key' => 'component_home_company_repeater',
                'label' => 'Content',
                'name' => 'home_company_repeater',
                'type' => 'repeater',
                'instructions' => 'Maximum 6 column',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'collapsed' => '',
                'min' => 2,
                'max' => 8,
                'layout' => 'block',
                'button_label' => '',
                'sub_fields' => array(
                    array(
                        'key' => 'component_home_company_name',
                        'label' => 'Company Name',
                        'name' => 'company_name',
                        'type' => 'text',
                        'instructions' => '&nbsp;',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '33',
                            'class' => '',
                            'id' => '',
                        ),
                    ),
                    array(
                        'key' => 'component_home_company_background_image',
                        'label' => 'Company Background Image',
                        'name' => 'company_background_image',
                        'type' => 'image',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '33',
                            'class' => '',
                            'id' => '',
                        ),
                        'return_format' => 'url',
                        'preview_size' => 'thumbnail',
                        'library' => 'all',
                        'min_width' => 0,
                        'min_height' => 0,
                        'min_size' => '',
                        'max_size' => '',
                        'mime_types' => 'svg, png, jpg, jpeg',
                    ),
                    array(
                        'key' => 'component_home_company_logo',
                        'label' => 'Company Logo',
                        'name' => 'company_logo',
                        'type' => 'image',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '33',
                            'class' => '',
                            'id' => '',
                        ),
                        'return_format' => 'url',
                        'preview_size' => 'thumbnail',
                        'library' => 'all',
                        'min_width' => 0,
                        'min_height' => 0,
                        'min_size' => '',
                        'max_size' => '',
                        'mime_types' => 'svg, png, jpg, jpeg',
                    ),
                    array(
                        'key' => 'component_home_company_subtitle',
                        'label' => 'Company Subtitle',
                        'name' => 'company_subtitle',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '100',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'tabs' => '',
                        'toolbar' => 'basic',
                        'media_upload' => 1,
                        'delay' => 1,
                    ),
                    array(
                        'key' => 'component_home_company_description',
                        'label' => 'Company Description',
                        'name' => 'company_description',
                        'type' => 'textarea',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '100',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'tabs' => '',
                        'toolbar' => 'basic',
                        'media_upload' => 1,
                        'delay' => 1,
                    ),
                    array(
                        'key' => 'component_home_company_cta_enabled',
                        'label' => 'Enable CTA',
                        'name' => 'enable_cta',
                        'type' => 'true_false',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '20',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => '',
                        'default_value' => 0,
                        'ui' => 1,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                    ),
                    array(
                        'key' => 'component_home_company_cta_url',
                        'label' => 'CTA URL',
                        'name' => 'cta_url',
                        'type' => 'link',
                        'instructions' => 'please enter a valid url',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'component_home_company_cta_enabled',
                                    'operator' => '==',
                                    'value' => '1',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '80',
                            'class' => '',
                            'id' => '',
                        ),
                        'return_format' => 'url',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'component_home_company_cta_product_category',
                        'label' => 'Category ID',
                        'name' => 'cta_product_category',
                        'type' => 'taxonomy',
                        'instructions' => 'Select product category to be added to the link',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'taxonomy' => 'product_cat',
                        'field_type' => 'checkbox',
                        'add_term' => 0,
                        'save_terms' => 0,
                        'load_terms' => 0,
                        'return_format' => 'object',
                        'multiple' => 0,
                        'allow_null' => 0,
                    ),
                ),
            ),
        ),
    )
);