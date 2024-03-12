<?php

$priority = 1;

/**
 * Header Position
 */
Kirki::add_field(
	'arrigo',
	array(
		'type'     => 'radio-buttonset',
		'settings' => 'header_position',
		'label'    => esc_attr__( 'Position', 'arrigo' ),
		'tooltip'  => esc_attr__( 'Note: This option may be overriden for the current page from Elementor document settings.', 'arrigo' ),
		'section'  => 'position',
		'default'  => 'header_absolute',
		'priority' => $priority++,
		'choices'  => array(
			'header_relative' => esc_attr__( 'Relative', 'arrigo' ),
			'header_absolute' => esc_attr__( 'Absolute', 'arrigo' ),
		),
	)
);

/**
 * Header Sticky
 */
Kirki::add_field(
	'arrigo',
	array(
		'type'        => 'switch',
		'settings'    => 'header_sticky',
		'label'       => __( 'Sticky', 'arrigo' ),
		'description' => __( 'Stick header to the top on page scroll', 'arrigo' ),
		'tooltip'     => __( 'Note: This option may be overriden for the current page from Elementor document settings.', 'arrigo' ),
		'section'     => 'position',
		'default'     => true,
		'priority'    => $priority++,
		'choices'     => array(
			true  => esc_attr__( 'On', 'arrigo' ),
			false => esc_attr__( 'Off', 'arrigo' ),
		),
	)
);
