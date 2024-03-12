<?php

$priority = 1;

/**
 * Outdated Browsers
 */
Kirki::add_section(
	'outdated_browsers',
	array(
		'title'    => esc_attr__( 'Outdated Browsers', 'arrigo' ),
		'priority' => $priority ++,
		'panel'    => 'page',
	)
);
get_template_part( '/inc/customizer/panels/page/sections/outdated-browsers' );

/**
 * Section Portfolio
 */
Kirki::add_section(
	'portfolio',
	array(
		'title'    => esc_attr__( 'Portfolio', 'arrigo' ),
		'priority' => $priority ++,
		'panel'    => 'page',
	)
);
get_template_part( '/inc/customizer/panels/page/sections/portfolio' );

/**
 * Section Services
 */
Kirki::add_section(
	'services',
	array(
		'title'    => esc_attr__( 'Services', 'arrigo' ),
		'priority' => $priority ++,
		'panel'    => 'page',
	)
);
get_template_part( '/inc/customizer/panels/page/sections/services' );

/**
 * Section Page 404
 */
Kirki::add_section(
	'404',
	array(
		'title'    => esc_attr__( 'Page 404', 'arrigo' ),
		'priority' => $priority ++,
		'panel'    => 'page',
	)
);
get_template_part( '/inc/customizer/panels/page/sections/404' );

/**
 * Section CF7
 */
Kirki::add_section(
	'contact_form_7',
	array(
		'title'    => esc_attr__( 'Contact Form 7', 'arrigo' ),
		'priority' => $priority ++,
		'panel'    => 'page',
	)
);
get_template_part( '/inc/customizer/panels/page/sections/contact-form-7' );
