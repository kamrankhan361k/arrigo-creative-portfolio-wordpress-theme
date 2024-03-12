<?php

$priority = 1;

/**
 * Primary Accent Color
 */
Kirki::add_field(
	'arrigo',
	array(
		'section'     => 'theme_colors',
		'type'        => 'color',
		'label'       => esc_attr__( 'Primary Accent Color', 'arrigo' ),
		'description' => esc_attr__( 'Used for interactive elements, decorations, etc', 'arrigo' ),
		'default'     => '#b68c70',
		'settings'    => 'color_accent_primary',
		'priority'    => $priority ++,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element'  => ':root',
				'property' => '--color-accent-primary',
			),
		),
	)
);

/**
 * Secondary Accent Color
 */
Kirki::add_field(
	'arrigo',
	array(
		'section'     => 'theme_colors',
		'type'        => 'color',
		'label'       => esc_attr__( 'Secondary Accent Color', 'arrigo' ),
		'description' => esc_attr__( 'Used for hover and additonal styling.', 'arrigo' ),
		'default'     => '#9b724d',
		'settings'    => 'color_accent_secondary',
		'priority'    => $priority ++,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element'  => ':root',
				'property' => '--color-accent-secondary',
			),
		),
	)
);
