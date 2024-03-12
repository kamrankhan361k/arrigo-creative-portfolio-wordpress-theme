<?php

$priority = 1;

/**
 * Section Style
 */
Kirki::add_section(
	'style',
	array(
		'title'    => esc_attr__( 'Style', 'arrigo' ),
		'priority' => $priority ++,
		'panel'    => 'header',
	)
);
get_template_part( '/inc/customizer/panels/header/sections/style' );


/**
 * Section Position & Sticky
 */
Kirki::add_section(
	'position',
	array(
		'title'    => esc_attr__( 'Position & Sticky', 'arrigo' ),
		'priority' => $priority ++,
		'panel'    => 'header',
	)
);
get_template_part( '/inc/customizer/panels/header/sections/position' );


/**
 * Section Menu
 */
Kirki::add_section(
	'menu',
	array(
		'title'    => esc_attr__( 'Menu', 'arrigo' ),
		'priority' => $priority ++,
		'panel'    => 'header',
	)
);
get_template_part( '/inc/customizer/panels/header/sections/menu' );

/**
 * Close Button
 */
Kirki::add_section(
	'close',
	array(
		'title'    => esc_attr__( 'Close Button', 'arrigo' ),
		'priority' => $priority ++,
		'panel'    => 'header',
	)
);
get_template_part( '/inc/customizer/panels/header/sections/close' );

/**
 * Masthead
 */
Kirki::add_section(
	'masthead',
	array(
		'title'    => esc_attr__( 'Masthead', 'arrigo' ),
		'priority' => $priority ++,
		'panel'    => 'header',
	)
);
get_template_part( '/inc/customizer/panels/header/sections/masthead' );
