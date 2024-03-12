<?php

$priority = 1;

/**
 * Post Date Style
 */
Kirki::add_field(
	'arrigo',
	array(
		'type'     => 'radio-buttonset',
		'settings' => 'post_date_style',
		'label'    => esc_attr__( 'Date Style', 'arrigo' ),
		'section'  => 'post',
		'default'  => 'square_box',
		'priority' => $priority++,
		'choices'  => array(
			'info'       => esc_attr__( 'As post info', 'arrigo' ),
			'square_box' => esc_attr__( 'In square box', 'arrigo' ),
		),
	)
);

/**
 * Post Show All Info
 */
Kirki::add_field(
	'arrigo',
	array(
		'type'        => 'switch',
		'settings'    => 'post_show_info',
		'label'       => esc_attr__( 'Show All info', 'arrigo' ),
		'description' => esc_attr__( 'Show post information (posted date, author, comments, etc...).', 'arrigo' ),
		'section'     => 'post',
		'default'     => 'on',
		'priority'    => $priority++,
		'choices'     => array(
			true  => esc_attr__( 'On', 'arrigo' ),
			false => esc_attr__( 'Off', 'arrigo' ),
		),
	)
);

/**
 * Post Date
 */
Kirki::add_field(
	'arrigo',
	array(
		'type'            => 'checkbox',
		'settings'        => 'post_show_date',
		'label'           => esc_attr__( 'Show Date', 'arrigo' ),
		'section'         => 'post',
		'default'         => 'on',
		'priority'        => $priority++,
		'choices'         => array(
			true  => esc_attr__( 'On', 'arrigo' ),
			false => esc_attr__( 'Off', 'arrigo' ),
		),
		'active_callback' => array(
			array(
				'setting' => 'post_show_info',
				'value'   => true,
			),
		),
	)
);

/**
 * Post Categories
 */
Kirki::add_field(
	'arrigo',
	array(
		'type'            => 'checkbox',
		'settings'        => 'post_show_categories',
		'label'           => esc_attr__( 'Show Categories', 'arrigo' ),
		'section'         => 'post',
		'default'         => 'on',
		'priority'        => $priority++,
		'choices'         => array(
			true  => esc_attr__( 'On', 'arrigo' ),
			false => esc_attr__( 'Off', 'arrigo' ),
		),
		'active_callback' => array(
			array(
				'setting' => 'post_show_info',
				'value'   => true,
			),
		),
	)
);

/**
 * Post Comments Counter
 */
Kirki::add_field(
	'arrigo',
	array(
		'type'            => 'checkbox',
		'settings'        => 'post_show_comments_counter',
		'label'           => esc_attr__( 'Show Comments Counter', 'arrigo' ),
		'section'         => 'post',
		'default'         => 'on',
		'priority'        => $priority++,
		'choices'         => array(
			true  => esc_attr__( 'On', 'arrigo' ),
			false => esc_attr__( 'Off', 'arrigo' ),
		),
		'active_callback' => array(
			array(
				'setting' => 'post_show_info',
				'value'   => true,
			),
		),
	)
);

/**
 * Post Author
 */
Kirki::add_field(
	'arrigo',
	array(
		'type'            => 'checkbox',
		'settings'        => 'post_show_author',
		'label'           => esc_attr__( 'Show Author', 'arrigo' ),
		'section'         => 'post',
		'default'         => 'on',
		'priority'        => $priority++,
		'choices'         => array(
			true  => esc_attr__( 'On', 'arrigo' ),
			false => esc_attr__( 'Off', 'arrigo' ),
		),
		'active_callback' => array(
			array(
				'setting' => 'post_show_info',
				'value'   => true,
			),
		),
	)
);

/**
 * Post Read More Button
 */
Kirki::add_field(
	'arrigo',
	array(
		'type'            => 'checkbox',
		'settings'        => 'post_show_read_more',
		'label'           => esc_attr__( 'Show "More" Button', 'arrigo' ),
		'section'         => 'post',
		'default'         => 'on',
		'priority'        => $priority++,
		'choices'         => array(
			true  => esc_attr__( 'On', 'arrigo' ),
			false => esc_attr__( 'Off', 'arrigo' ),
		),
		'active_callback' => array(
			array(
				'setting' => 'post_show_info',
				'value'   => true,
			),
		),
	)
);
