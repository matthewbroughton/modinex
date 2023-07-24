<?php
$fields = array(
	'component_featured_projects' => array(
		'key' => 'component_featured_projects',
		'name' => 'featured_projects',
		'label' => 'Featured Projects',
		'display' => 'block',
		'sub_fields' => array(
			//Component Settings Tab
			array(
				'key' => 'component_featured_projects_tab_setting',
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
				'key' => 'component_featured_projects_component_enabled',
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
				'key' => 'component_featured_projects_field_id',
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
				'key' => 'component_featured_projects_field_class',
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
				'key' => 'component_featured_projects_tab_content',
				'label' => 'Content',
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'component_featured_projects_component_enabled',
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
				'key' => 'component_featured_projects_title',
				'label' => 'Title',
				'name' => 'title',
				'type' => 'text',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '75',
					'class' => '',
					'id' => '',
				),
			),
			array(
				'key' => 'component_featured_projects_link_enabled',
				'label' => 'Show Feature Link?',
				'name' => 'enable_link',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '25',
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
				'key' => 'component_featured_projects_link',
				'label' => 'Feature Link',
				'name' => 'feature_link',
				'type' => 'link',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
			),
			array(
				'key' => 'component_featured_projects_grid_items',
				'label' => 'Projects',
				'name' => 'projects',
				'type' => 'relationship',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				"post_type" => array(
					"project"
				),
				"post_status" => array(
					"publish"
				),
				"taxonomy" => "",
				"filters" => array(
					"search",
					"post_type",
					"taxonomy"
				),
				"return_format" => "object",
				"min" => "",
				"max" => "4",
				"elements" => ""
			)
		),
	),
);
