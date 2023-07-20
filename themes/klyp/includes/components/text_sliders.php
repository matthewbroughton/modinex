<?php
$fields = array(
    'component_text_sliders' => array(
        'key' => 'component_text_sliders',
        'name' => 'text_sliders',
        'label' => 'Text Sliders',
        'display' => 'block',
        'sub_fields' => array(
            //Component Settings Tab
            array(
                'key' => 'component_text_sliders_tab_setting',
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
                'key' => 'component_text_sliders_component_enabled',
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
                'key' => 'component_text_sliders_field_id',
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
                'key' => 'component_text_sliders_field_class',
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
                'key' => 'component_text_sliders_tab_content',
                'label' => 'Content',
                'name' => '',
                'type' => 'tab',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'component_text_sliders_component_enabled',
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
                'key' => 'component_text_sliders_background_image',
                'label' => 'Background Image',
                'name' => 'background_image',
                'type' => 'image',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '100',
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
                'key' => 'component_text_sliders_repeater',
                'label' => 'Content',
                'name' => 'text_sliders_repeater',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '70',
                    'class' => '',
                    'id' => '',
                ),
                'collapsed' => '',
                'min' => 1,
                'max' => '',
                'layout' => 'block',
                'button_label' => '',
                'sub_fields' => array(
                    array(
                        'key' => 'component_text_sliders_title',
                        'label' => 'Title',
                        'name' => 'title',
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
                        'key' => 'component_text_sliders_feature_description',
                        'label' => 'Feature Description',
                        'name' => 'feature_description',
                        'type' => 'wysiwyg',
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
                ),
            ),
            array(
                'key' => 'component_client_img_repeater',
                'label' => 'Content',
                'name' => 'client_img_repeater',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '30',
                    'class' => '',
                    'id' => '',
                ),
                'collapsed' => '',
                'min' => 1,
                'max' => '',
                'layout' => 'block',
                'button_label' => '',
                'sub_fields' => array(
                    array(
                        'key' => 'component_client_img',
                        'label' => 'Client Image',
                        'name' => 'client_img',
                        'type' => 'image',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '100',
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
                        'key' => 'component_client_url',
                        'label' => 'Client URL',
                        'name' => 'client_url',
                        'type' => 'link',
                        'instructions' => 'please enter a valid url',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '80',
                            'class' => '',
                            'id' => '',
                        ),
                        'return_format' => 'array',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                ),
            ),
        ),
    )
);
