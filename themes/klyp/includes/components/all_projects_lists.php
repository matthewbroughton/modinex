<?php
$fields = array(
    'component_all_projects_lists' => array(
        'key' => 'component_all_projects_lists',
        'name' => 'all_projects_lists',
        'label' => 'All Projects Lists (Project)',
        'display' => 'block',
        'sub_fields' => array(
            //Component Settings Tab
            array(
                'key' => 'component_all_projects_lists_tab_setting',
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
                'key' => 'component_all_projects_lists_component_enabled',
                'label' => 'Show This Component?',
                'name' => 'enable_component',
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
                'key' => 'component_all_projects_lists_field_id',
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
                'key' => 'component_all_projects_lists_field_class',
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
                'key' => 'component_all_projects_lists_tab_content',
                'label' => 'Content',
                'name' => '',
                'type' => 'tab',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'component_all_projects_lists_component_enabled',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '30',
                    'class' => '',
                    'id' => '',
                ),
                'placement' => 'top',
                'endpoint' => 0,
            ),
            array(
                'key' => 'component_all_projects_list_title',
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
        ),
    )
);
