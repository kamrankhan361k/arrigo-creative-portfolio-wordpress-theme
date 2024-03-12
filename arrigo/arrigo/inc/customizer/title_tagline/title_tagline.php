<?php

$priority = 9;

$lg = get_option( 'elementor_viewport_lg', '992' );
$md = get_option( 'elementor_viewport_md', '768' );
$sm = get_option( 'elementor_viewport_sm', '480' );

/**
 * Retina Logo
 */
Kirki::add_field(
	'arrigo',
	array(
		'type'            => 'image',
		'settings'        => 'custom_logo_retina_url',
		'label'           => esc_html__( 'Retina Logo', 'arrigo' ),
		'description'     => esc_html__( 'Upload site logo in @2x resolution for smooth display on high-dpi screens.', 'arrigo' ),
		'section'         => 'title_tagline',
		'default'         => '',
		'priority'        => $priority,
		'active_callback' => array(
			array(
				'setting'  => 'custom_logo',
				'operator' => '!=',
				'value'    => false,
			),
		),
	)
);

/**
 * Alternative Logo
 */
Kirki::add_field(
	'arrigo',
	array(
		'type'            => 'image',
		'settings'        => 'alternate_logo_url',
		'label'           => esc_html__( 'Alternative Logo', 'arrigo' ),
		'section'         => 'title_tagline',
		'default'         => '',
		'priority'        => $priority,
		'active_callback' => array(
			array(
				'setting'  => 'custom_logo',
				'operator' => '!=',
				'value'    => false,
			),
		),
	)
);


/**
 * Alternate Retina Logo
 */
Kirki::add_field(
	'arrigo',
	array(
		'type'            => 'image',
		'settings'        => 'alternate_logo_retina_url',
		'label'           => esc_html__( 'Alternate Retina Logo', 'arrigo' ),
		'description'     => esc_html__( 'Upload site logo in @2x resolution for smooth display on high-dpi screens.', 'arrigo' ),
		'section'         => 'title_tagline',
		'default'         => '',
		'priority'        => $priority,
		'active_callback' => array(
			array(
				'setting'  => 'alternate_logo_url',
				'operator' => '!=',
				'value'    => false,
			),
			array(
				'setting'  => 'custom_logo',
				'operator' => '!=',
				'value'    => false,
			),
		),
	)
);

/**
 * Logo Max Height Desktop
 */
Kirki::add_field(
	'arrigo',
	array(
		'type'            => 'slider',
		'settings'        => 'custom_logo_max_height',
		'label'           => esc_html__( 'Logo Max Height', 'arrigo' ),
		'description'     => esc_html__( 'Desktop screens', 'arrigo' ),
		'section'         => 'title_tagline',
		'default'         => 80,
		'choices'         => array(
			'min'  => 0,
			'max'  => 512,
			'step' => 1,
		),
		'priority'        => $priority,
		'transport'       => 'auto',
		'output'          => array(
			array(
				'element'     => '.logo__wrapper-img img',
				'property'    => 'height',
				'units'       => 'px',
				'media_query' => '@media (min-width: ' . esc_attr( $md + 1 ) . 'px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'custom_logo',
				'operator' => '!=',
				'value'    => false,
			),
		),
	)
);

/**
 * Logo Max Height Tablet
 */
Kirki::add_field(
	'arrigo',
	array(
		'type'            => 'slider',
		'settings'        => 'custom_logo_max_height_tablet',
		'label'           => esc_html__( 'Logo Max Height', 'arrigo' ),
		'description'     => sprintf(
			'%1s %2s%3s %4s',
			esc_html__( 'Tablet screens', 'arrigo' ),
			esc_attr( $md ),
			esc_html__( 'px', 'arrigo' ),
			esc_html__( 'and lower', 'arrigo' )
		),
		'section'         => 'title_tagline',
		'default'         => 80,
		'choices'         => array(
			'min'  => 0,
			'max'  => 512,
			'step' => 1,
		),
		'priority'        => $priority,
		'transport'       => 'auto',
		'output'          => array(
			array(
				'element'     => '.logo__wrapper-img img',
				'property'    => 'height',
				'units'       => 'px',
				'media_query' => '@media (max-width: ' . esc_attr( $md ) . 'px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'custom_logo',
				'operator' => '!=',
				'value'    => false,
			),
		),
	)
);

/**
 * Logo Max Height Mobile
 */
Kirki::add_field(
	'arrigo',
	array(
		'type'            => 'slider',
		'settings'        => 'custom_logo_max_height_mobile',
		'label'           => esc_html__( 'Logo Max Height', 'arrigo' ),
		'description'     => sprintf(
			'%1s %2s%3s %4s',
			esc_html__( 'Mobile screens', 'arrigo' ),
			esc_attr( $sm ),
			esc_html__( 'px', 'arrigo' ),
			esc_html__( 'and lower', 'arrigo' )
		),
		'section'         => 'title_tagline',
		'default'         => 80,
		'choices'         => array(
			'min'  => 0,
			'max'  => 512,
			'step' => 1,
		),
		'priority'        => $priority,
		'transport'       => 'auto',
		'output'          => array(
			array(
				'element'     => '.logo__wrapper-img img',
				'property'    => 'height',
				'units'       => 'px',
				'media_query' => '@media (max-width: ' . esc_attr( $sm ) . 'px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'custom_logo',
				'operator' => '!=',
				'value'    => false,
			),
		),
	)
);

