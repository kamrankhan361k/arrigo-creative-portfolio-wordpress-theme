<?php

/**
 * Remove Elementor welcome splash screen
 * on the initial plugin activation
 * This prevents some issues when Merlin wizard
 * installs and activates the required plugins
 */
add_action( 'init', 'arr_remove_elementor_welcome_screen' );
function arr_remove_elementor_welcome_screen() {
	delete_transient( 'elementor_activation_redirect' );
}

/**
 * Register theme locations for Elementor Theme Builder API
 */
add_action( 'elementor/theme/register_locations', 'arr_register_elementor_locations' );
function arr_register_elementor_locations( $elementor_theme_manager ) {
	$elementor_theme_manager->register_location( 'header' );
	$elementor_theme_manager->register_location( 'footer' );
	$elementor_theme_manager->register_location( 'popup' );
	$elementor_theme_manager->register_location( 'single-post' );
	$elementor_theme_manager->register_location( 'single-page' );
}

/**
 * Fix for "Additional Custom Breakpoints" feature
 */
add_action( 'elementor/init', 'arr_elementor_duplicate_responsive_controls' );
function arr_elementor_duplicate_responsive_controls() {
	if ( arr_is_elementor_feature_active( 'additional_custom_breakpoints' ) ) {
		\Elementor\Plugin::$instance->breakpoints->set_responsive_control_duplication_mode( 'on' );
	}
}
