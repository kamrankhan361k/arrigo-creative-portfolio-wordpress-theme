<?php

require_once ARR_THEME_PATH . '/inc/classes/class-arr-nav-menu-walker.php';

/**
 * Register Theme Menus
 *
 * @return void
 */
add_action( 'after_setup_theme', 'arr_init_navigation' );
function arr_init_navigation() {
	if ( function_exists( 'register_nav_menus' ) ) {
		register_nav_menus(
			array(
				'main_menu' => esc_html__( 'Main Menu', 'arrigo' ),
			)
		);
	}
}

