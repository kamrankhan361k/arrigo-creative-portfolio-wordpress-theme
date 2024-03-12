<?php

$priority = 1;

/**
 * Header Style
 */
Kirki::add_field(
	'arrigo',
	array(
		'type'      => 'radio-buttonset',
		'settings'  => 'header_theme',
		'label'     => esc_attr__( 'Color Theme', 'arrigo' ),
		'tooltip'   => esc_attr__( 'Note: This option may be overriden for the current page from Elementor document settings.', 'arrigo' ),
		'section'   => 'style',
		'default'   => 'header_light',
		'priority'  => $priority++,
		'transport' => 'postMessage',
		'choices'   => array(
			'header_dark'   => esc_attr__( 'Dark', 'arrigo' ),
			'header_light'  => esc_attr__( 'Light', 'arrigo' ),
			'header_accent' => esc_attr__( 'Accent', 'arrigo' ),
		),
	)
);

/**
 * Logo to Display
 */
Kirki::add_field(
	'arrigo',
	array(
		'type'     => 'radio-buttonset',
		'settings' => 'header_logo_version',
		'label'    => esc_attr__( 'Logo to Display', 'arrigo' ),
		'tooltip'  => esc_attr__( 'Note: This option may be overriden for the current page from Elementor document settings.', 'arrigo' ),
		'section'  => 'style',
		'default'  => 'default',
		'priority' => $priority++,
		'choices'  => array(
			'default' => esc_attr__( 'Default', 'arrigo' ),
			'alt'     => esc_attr__( 'Alternative', 'arrigo' ),
		),
	)
);
