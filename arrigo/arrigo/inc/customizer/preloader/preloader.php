<?php

$priority = 1;

Kirki::add_section(
	'preloader',
	array(
		'title'    => esc_attr__( 'Preloader', 'arrigo' ),
		'priority' => $priority ++,
		'icon'     => 'dashicons-image-filter',
	)
);

/**
 * Preloader Type
 */
Kirki::add_field(
	'arrigo',
	array(
		'type'     => 'radio-buttonset',
		'settings' => 'preloader_type',
		'label'    => esc_attr__( 'Type', 'arrigo' ),
		'tooltip'  => esc_attr__( 'This option may be overriden for the current page from Elementor document settings.', 'arrigo' ),
		'section'  => 'preloader',
		'default'  => 'fadein',
		'priority' => $priority++,
		'choices'  => array(
			'curtains' => esc_attr__( 'Curtains', 'arrigo' ),
			'fadein'   => esc_attr__( 'Fade In', 'arrigo' ),
		),
	)
);

/**
 * Preloader Curtains Number
 */
Kirki::add_field(
	'arrigo',
	array(
		'type'            => 'slider',
		'settings'        => 'preloader_curtains_num',
		'label'           => esc_attr__( 'Number of curtains', 'arrigo' ),
		'tooltip'         => esc_attr__( 'This option may be overriden for the current page from Elementor document settings.', 'arrigo' ),
		'section'         => 'preloader',
		'default'         => 4,
		'priority'        => $priority++,
		'choices'         => array(
			'min'  => '1',
			'max'  => '12',
			'step' => '1',
		),
		'active_callback' => array(
			array(
				'setting'  => 'preloader_type',
				'operator' => '==',
				'value'    => 'curtains',
			),
		),
	)
);

/**
 * Preloader Style
 */
Kirki::add_field(
	'arrigo',
	array(
		'type'            => 'radio-buttonset',
		'settings'        => 'preloader_style',
		'label'           => esc_attr__( 'Curtains Color', 'arrigo' ),
		'tooltip'         => esc_attr__( 'This option may be overriden for the current page from Elementor document settings.', 'arrigo' ),
		'section'         => 'preloader',
		'default'         => 'preloader_light',
		'priority'        => $priority++,
		'choices'         => array(
			'preloader_dark'   => esc_attr__( 'Dark', 'arrigo' ),
			'preloader_light'  => esc_attr__( 'Light', 'arrigo' ),
			'preloader_accent' => esc_attr__( 'Accent', 'arrigo' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'preloader_type',
				'operator' => '==',
				'value'    => 'curtains',
			),
		),
	)
);
