<?php

/**
 * Hide ACF Menu
 */
add_filter( 'acf/settings/show_admin', '__return_false' );

/**
 * ACF Fields
 */
if ( function_exists( 'acf_add_local_field_group' ) ) {
	// custom fonts fields
	acf_add_local_field_group(
		array(
			'key'                   => 'group_5da01c79399ce',
			'title'                 => esc_html__( 'Custom Fonts', 'arrigo' ),
			'fields'                => array(
				array(
					'key'               => 'field_5da01caa50c9a',
					'label'             => '',
					'name'              => 'custom_fonts',
					'type'              => 'repeater',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'collapsed'         => 'field_5da01cfa50c9b',
					'min'               => 0,
					'max'               => 0,
					'layout'            => 'block',
					'button_label'      => esc_html__( 'Add Custom Font', 'arrigo' ),
					'sub_fields'        => array(
						array(
							'key'               => 'field_5da01cfa50c9b',
							'label'             => esc_html__( 'Font Family Name', 'arrigo' ),
							'name'              => 'font_name',
							'type'              => 'text',
							'instructions'      => '',
							'required'          => 1,
							'conditional_logic' => 0,
							'wrapper'           => array(
								'width' => '',
								'class' => '',
								'id'    => '',
							),
							'default_value'     => '',
							'placeholder'       => '',
							'prepend'           => '',
							'append'            => '',
							'maxlength'         => '',
						),
						array(
							'key'               => 'field_5da3c469ba39d',
							'label'             => esc_html__( 'Font Display', 'arrigo' ),
							'name'              => 'font_display',
							'type'              => 'select',
							'instructions'      => sprintf(
								'<a href="https://developer.mozilla.org/en-US/docs/Web/CSS/@font-face/font-display" target="_blank">%1s</a> %2s',
								esc_html__( 'More information', 'arrigo' ),
								esc_html__( 'related to "font-display" descriptor.', 'arrigo' )
							),
							'required'          => 1,
							'conditional_logic' => 0,
							'wrapper'           => array(
								'width' => '',
								'class' => '',
								'id'    => '',
							),
							'choices'           => array(
								'auto'     => 'auto',
								'block'    => 'block',
								'swap'     => 'swap',
								'fallback' => 'fallback',
								'optional' => 'optional',
							),
							'default_value'     => array(
								0 => 'auto',
							),
							'allow_null'        => 0,
							'multiple'          => 0,
							'ui'                => 0,
							'return_format'     => 'value',
							'ajax'              => 0,
							'placeholder'       => '',
						),
						array(
							'key'               => 'field_5da01d3550c9c',
							'label'             => esc_html__( 'Font Files', 'arrigo' ),
							'name'              => 'font_files',
							'type'              => 'repeater',
							'instructions'      => '',
							'required'          => 1,
							'conditional_logic' => 0,
							'wrapper'           => array(
								'width' => '',
								'class' => '',
								'id'    => '',
							),
							'collapsed'         => 'field_5da01e9550c9e',
							'min'               => 0,
							'max'               => 0,
							'layout'            => 'block',
							'button_label'      => esc_html__( 'Add Font File', 'arrigo' ),
							'sub_fields'        => array(
								array(
									'key'               => 'field_5da01d7250c9d',
									'label'             => 'Font File',
									'name'              => 'font_file',
									'type'              => 'file',
									'instructions'      => esc_html__( 'Upload .woff or .woff2 font file', 'arrigo' ),
									'required'          => 1,
									'conditional_logic' => 0,
									'wrapper'           => array(
										'width' => '',
										'class' => '',
										'id'    => '',
									),
									'return_format'     => 'array',
									'library'           => 'all',
									'min_size'          => '',
									'max_size'          => '',
									'mime_types'        => 'woff, woff2',
								),
								array(
									'key'               => 'field_5da01e9550c9e',
									'label'             => esc_html__( 'Font Weight', 'arrigo' ),
									'name'              => 'font_weight',
									'type'              => 'select',
									'instructions'      => esc_html__( 'Select a font weight of the uploaded font file', 'arrigo' ),
									'required'          => 1,
									'conditional_logic' => 0,
									'wrapper'           => array(
										'width' => '',
										'class' => '',
										'id'    => '',
									),
									'choices'           => array(
										100         => esc_html__( '100 (Thin)', 'arrigo' ),
										'100italic' => esc_html__( '100i (Thin Italic)', 'arrigo' ),
										200         => esc_html__( ' 200 (Ultra Light)', 'arrigo' ),
										'200italic' => esc_html__( '200i (Ultra Light Italic)', 'arrigo' ),
										300         => esc_html__( ' 300 (Light)', 'arrigo' ),
										'300italic' => esc_html__( '300i (Light Italic)', 'arrigo' ),
										400         => esc_html__( '400 (Regular)', 'arrigo' ),
										'400italic' => esc_html__( '400i (Regular Italic)', 'arrigo' ),
										500         => esc_html__( '500 (Medium)', 'arrigo' ),
										'500italic' => esc_html__( '500i (Medium Italic)', 'arrigo' ),
										600         => esc_html__( '600 (Semi Bold)', 'arrigo' ),
										'600italic' => esc_html__( '600i (Semi Bold Italic)', 'arrigo' ),
										700         => esc_html__( '700 (Bold)', 'arrigo' ),
										'700italic' => esc_html__( '700i (Bold Italic)', 'arrigo' ),
										800         => esc_html__( '800 (Extra Bold)', 'arrigo' ),
										'800italic' => esc_html__( '800i (Extra Bold Italic)', 'arrigo' ),
										900         => esc_html__( '900 (Black)', 'arrigo' ),
										'900italic' => esc_html__( '900i (Black Italic)', 'arrigo' ),
									),
									'default_value'     => array(),
									'allow_null'        => 0,
									'multiple'          => 0,
									'ui'                => 0,
									'return_format'     => 'value',
									'ajax'              => 0,
									'placeholder'       => '',
								),
							),
						),
					),
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'options_page',
						'operator' => '==',
						'value'    => 'custom-fonts-settings',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen'        => '',
			'active'                => true,
			'description'           => '',
		)
	);
}

/**
 * Custom Fonts Admin Page
 */
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page(
		array(
			'page_title'      => 'Custom Fonts',
			'menu_title'      => 'Custom Fonts',
			'menu_slug'       => 'custom-fonts-settings',
			'capability'      => 'customize',
			'icon_url'        => 'dashicons-editor-textcolor',
			'update_button'   => esc_html__( 'Save Changes', 'arrigo' ),
			'updated_message' => sprintf(
				'%1s <a href="%2s" target="_blank">%3s</a>',
				esc_html__( 'Fonts are saved and ready to use from', 'arrigo' ),
				admin_url( 'customize.php' ),
				esc_html__( 'WordPress Customizer.', 'arrigo' )
			),
		)
	);
}
