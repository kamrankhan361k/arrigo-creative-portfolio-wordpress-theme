<?php

$priority = 1;

/**
 * Sidebar Position
 */
Kirki::add_field(
	'arrigo',
	array(
		'type'        => 'radio-buttonset',
		'settings'    => 'sidebar_position',
		'label'       => esc_attr__( 'Sidebar Position', 'arrigo' ),
		'description' => esc_attr__( ' This option has an effect only on desktop. On mobile the sidebar is always below the content.', 'arrigo' ),
		'tooltip'     => esc_attr__( 'You can also disable blog sidebar from the admin panel', 'arrigo' ),
		'section'     => 'sidebar',
		'default'     => 'right_side',
		'priority'    => $priority++,
		'choices'     => array(
			'left_side'  => esc_attr__( 'Left Side', 'arrigo' ),
			'right_side' => esc_attr__( 'Right Side', 'arrigo' ),
		),
		'transport'   => 'postMessage',
	)
);
