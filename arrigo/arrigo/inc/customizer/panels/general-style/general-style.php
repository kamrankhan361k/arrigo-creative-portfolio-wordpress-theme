<?php

$priority = 1;

/**
 * Colors
 */
Kirki::add_section(
	'theme_colors',
	array(
		'title'    => esc_attr__( 'Colors', 'arrigo' ),
		'panel'    => 'general-style',
		'priority' => $priority ++,
	)
);
get_template_part( '/inc/customizer/panels/general-style/sections/colors' );

/**
 * Typography
 */
Kirki::add_section(
	'typography',
	array(
		'title'    => esc_attr__( 'Typography', 'arrigo' ),
		'panel'    => 'general-style',
		'priority' => $priority ++,
	)
);
get_template_part( '/inc/customizer/panels/general-style/sections/typography' );
