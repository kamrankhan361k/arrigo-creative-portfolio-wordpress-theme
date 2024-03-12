<?php

$priority = 1;

/**
 * Featured Image
 */
Kirki::add_field(
	'arrigo',
	array(
		'type'     => 'switch',
		'settings' => 'enable_masthead_image',
		'label'    => esc_attr__( 'Enable Featured Image in Masthead', 'arrigo' ),
		'section'  => 'masthead',
		'default'  => false,
		'priority' => $priority++,
	)
);

/**
 * Featured Image Overlay
 */
Kirki::add_field(
	'arrigo',
	array(
		'type'            => 'slider',
		'settings'        => 'masthead_image_overlay_opacity',
		'label'           => esc_attr__( 'Image Overlay Opacity', 'arrigo' ),
		'section'         => 'masthead',
		'default'         => 0.6,
		'priority'        => $priority++,
		'choices'         => array(
			'min'  => 0,
			'max'  => 1,
			'step' => 0.01,
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_masthead_image',
				'operator' => '==',
				'value'    => true,
			),
		),
		'transport'       => 'auto',
		'output'          => array(
			array(
				'element'  => '.section-masthead__overlay',
				'property' => 'opacity',
			),
		),
	)
);
