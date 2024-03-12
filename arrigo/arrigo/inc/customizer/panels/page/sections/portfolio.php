<?php

$priority = 1;

/**
 * Portfolio Nav Style
 */
Kirki::add_field(
	'arrigo',
	array(
		'type'     => 'radio-buttonset',
		'settings' => 'portfolio_nav_style',
		'label'    => esc_attr__( 'Portfolio Navigation Style', 'arrigo' ),
		'section'  => 'portfolio',
		'priority' => $priority++,
		'default'  => 'next',
		'choices'  => array(
			'next'      => 'Next',
			'next-prev' => 'Prev + Next',
		),
	)
);

/**
 * Portfolio Nav Direction
 */
Kirki::add_field(
	'arrigo',
	array(
		'type'            => 'radio-buttonset',
		'settings'        => 'portfolio_nav_direction',
		'label'           => esc_attr__( 'Portfolio "Next" Navigation Direction', 'arrigo' ),
		'section'         => 'portfolio',
		'priority'        => $priority++,
		'default'         => 'backward',
		'choices'         => array(
			'backward' => 'Backward',
			'forward'  => 'Forward',
		),
		'active_callback' => array(
			array(
				'setting'  => 'portfolio_nav_style',
				'operator' => '==',
				'value'    => 'next',
			),
		),
	)
);

/**
 * Portfolio Custom Slug Option
 */
Kirki::add_field(
	'arrigo',
	array(
		'type'     => 'switch',
		'settings' => 'enable_custom_portfolio_slug',
		'label'    => esc_html__( 'Enable custom portfolio slug', 'arrigo' ),
		'section'  => 'portfolio',
		'default'  => false,
		'priority' => $priority++,
	)
);

Kirki::add_field(
	'arrigo',
	array(
		'type'            => 'text',
		'settings'        => 'portfolio_slug',
		'label'           => esc_html__( 'Portfolio Slug', 'arrigo' ),
		'description'     => sprintf(
			'%1$s <a href="%2$s" target="_blank">%3$s</a> %4$s',
			esc_html__( 'Note: you will need to', 'arrigo' ),
			admin_url( 'options-permalink.php' ),
			esc_html__( 'update your permalinks', 'arrigo' ),
			esc_html__( 'each time you change the slug.', 'arrigo' )
		),
		'section'         => 'portfolio',
		'default'         => esc_html__( 'portfolio', 'arrigo' ),
		'priority'        => $priority++,
		'active_callback' => array(
			array(
				'setting'  => 'enable_custom_portfolio_slug',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);
