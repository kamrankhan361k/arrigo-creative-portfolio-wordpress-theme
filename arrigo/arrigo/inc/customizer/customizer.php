<?php

if ( ! class_exists( 'Kirki' ) ) {
	return;
}

add_filter( 'kirki_telemetry', '__return_false' );

$priority = 1;

Kirki::add_config(
	'arrigo',
	array(
		'capability'  => 'edit_theme_options',
		'option_type' => 'theme_mod',
	)
);

/**
 * Section Preloader
 */
get_template_part( 'inc/customizer/preloader/preloader' );

/**
 * Panel General Style
 */
Kirki::add_panel(
	'general-style',
	array(
		'priority' => $priority++,
		'title'    => esc_attr__( 'General Style', 'arrigo' ),
		'icon'     => 'dashicons-admin-appearance',
	)
);
get_template_part( '/inc/customizer/panels/general-style/general-style' );

/**
 * Panel Header
 */
Kirki::add_panel(
	'header',
	array(
		'priority' => $priority++,
		'title'    => esc_attr__( 'Header', 'arrigo' ),
		'icon'     => 'dashicons-arrow-up-alt',
	)
);
get_template_part( '/inc/customizer/panels/header/header' );

/**
 * Panel Footer
 */
Kirki::add_panel(
	'footer',
	array(
		'priority' => $priority++,
		'title'    => esc_attr__( 'Footer', 'arrigo' ),
		'icon'     => 'dashicons-arrow-down-alt',
	)
);
get_template_part( '/inc/customizer/panels/footer/footer' );

/**
 * Panel Blog
 */
Kirki::add_panel(
	'blog',
	array(
		'priority' => $priority++,
		'title'    => esc_attr__( 'Blog', 'arrigo' ),
		'icon'     => 'dashicons-editor-bold',
	)
);
get_template_part( '/inc/customizer/panels/blog/blog' );

/**
 * Panel Options
 */
Kirki::add_panel(
	'page',
	array(
		'priority' => $priority++,
		'title'    => esc_attr__( 'Options', 'arrigo' ),
		'icon'     => 'dashicons-admin-tools',
	)
);
get_template_part( '/inc/customizer/panels/page/page' );

/**
 * Extend Title & Tagline Section
 */
get_template_part( 'inc/customizer/title_tagline/title_tagline' );
