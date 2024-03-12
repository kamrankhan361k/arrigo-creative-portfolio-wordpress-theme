<?php

$priority    = 1;
$max_columns = 8;

/**
 * Footer Layout
 */
Kirki::add_field(
	'arrigo',
	array(
		'type'        => 'slider',
		'settings'    => 'footer_columns',
		'label'       => esc_attr__( 'Number of Columns', 'arrigo' ),
		'description' => esc_attr__( 'This setting creates a widget area per each column. You can edit your widgets in WordPress admin panel.', 'arrigo' ),
		'section'     => 'layout',
		'default'     => 3,
		'priority'    => $priority++,
		'choices'     => array(
			'min'  => '1',
			'max'  => $max_columns,
			'step' => '1',
		),
		'transport'   => 'refresh',
	)
);

/**
 * Mobile Ordering Info
 */
Kirki::add_field(
	'arrigo',
	array(
		'type'            => 'custom',
		'settings'        => 'footer_columns_info',
		'label'           => esc_attr__( 'Mobile Columns Stack Order', 'arrigo' ),
		'description'     => esc_attr__( 'You can control how your columns stack on mobile screens. For example, you can place copyright column very first on desktop and reorder it as very last on mobile.', 'arrigo' ),
		'section'         => 'layout',
		'priority'        => $priority++,
		'active_callback' => array(
			array(
				'setting'  => 'footer_columns',
				'operator' => '>',
				'value'    => '1',
			),
		),
	)
);

/**
 * Mobile Column Order
 */

for ( $i = 1; $i <= $max_columns; $i++ ) {

	$descr = sprintf( '%1$s (%2$s %3$s)', esc_attr__( 'Mobile Order', 'arrigo' ), esc_attr__( 'Column', 'arrigo' ), $i );

	Kirki::add_field(
		'arrigo',
		array(
			'type'            => 'slider',
			'settings'        => 'order_column_' . $i,
			'description'     => $descr,
			'section'         => 'layout',
			'default'         => 1,
			'priority'        => $priority++,
			'choices'         => array(
				'min'  => '1',
				'max'  => $max_columns,
				'step' => '1',
			),
			'active_callback' => array(
				array(
					'setting'  => 'footer_columns',
					'operator' => '>=',
					'value'    => $i,
				),
				array(
					'setting'  => 'footer_columns',
					'operator' => '!=',
					'value'    => 1,
				),
			),
		)
	);

}
