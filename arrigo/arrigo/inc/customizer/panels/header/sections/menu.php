<?php

$priority = 1;

/**
 * Menu Style
 */
Kirki::add_field(
	'arrigo',
	array(
		'type'        => 'radio-buttonset',
		'settings'    => 'menu_style',
		'label'       => esc_attr__( 'Style', 'arrigo' ),
		'description' => esc_attr__( 'This option has an effect only on desktop. On mobile there is always a fullscreen overlay menu.', 'arrigo' ),
		'tooltip'     => esc_attr__( 'This option may be overriden for the current page from Elementor document settings.', 'arrigo' ),
		'section'     => 'menu',
		'default'     => 'regular',
		'priority'    => $priority++,
		'choices'     => array(
			'regular'    => esc_attr__( 'Regular', 'arrigo' ),
			'fullscreen' => esc_attr__( 'Fullscreen Overlay', 'arrigo' ),
		),
	)
);
