<?php

/**
 * Import Demo Data
 */
add_filter( 'merlin_import_files', 'arr_merlin_import_files' );
function arr_merlin_import_files() {
	return array(
		array(
			'import_file_name'           => 'Demo Import',
			'import_file_url'            => 'https://artemsemkin.com/' . ARR_THEME_SLUG . '/demo-content/demo-content.xml',
			'import_widget_file_url'     => 'https://artemsemkin.com/' . ARR_THEME_SLUG . '/demo-content/widgets.wie',
			'import_customizer_file_url' => 'https://artemsemkin.com/' . ARR_THEME_SLUG . '/demo-content/customizer.dat',
			'preview_url'                => 'https://artemsemkin.com/' . ARR_THEME_SLUG . '/wp/',
		),
	);
}

/**
 * Child theme screenshot
 */
add_filter( 'merlin_generate_child_screenshot', 'arr_merlin_generate_child_screenshot' );
function arr_merlin_generate_child_screenshot() {
	return ARR_THEME_PATH . '/inc/merlin/assets/images/screenshot.jpg';
}

/**
 * Setup Elementor
 */
add_filter( 'merlin_after_all_import', 'arr_merlin_setup_elementor' );
add_filter( 'pt-ocdi/after_import', 'arr_merlin_setup_elementor' );
function arr_merlin_setup_elementor() {

	$cpt_support = get_option( 'elementor_cpt_support' );

	// Update CPT Support
	if ( ! $cpt_support ) {

		$cpt_support = array( 'page', 'post', 'arr_portfolio', 'arr_services' );
		update_option( 'elementor_cpt_support', $cpt_support );

	} elseif ( ! in_array( 'arr_portfolio', $cpt_support ) ) {

		$cpt_support[] = 'arr_portfolio';
		update_option( 'elementor_cpt_support', $cpt_support );

	} elseif ( ! in_array( 'arr_services', $cpt_support ) ) {

		$cpt_support[] = 'arr_services';
		update_option( 'elementor_cpt_support', $cpt_support );

	}

	// Update Default space between widgets
	update_option( 'elementor_space_between_widgets', '30' );

	// Update Content width
	update_option( 'elementor_container_width', '1140' );

	// Update Breakpoints
	update_option( 'elementor_viewport_lg', '992' );
	update_option( 'elementor_viewport_md', '768' );

	// Update Page title selector
	update_option( 'elementor_page_title_selector', '.section-masthead h1' );

	// Update Disable default color schemes and fonts
	update_option( 'elementor_disable_color_schemes', 'yes' );
	update_option( 'elementor_disable_typography_schemes', 'yes' );

}

/**
 * Setup Menu
 */
add_filter( 'merlin_after_all_import', 'arr_merlin_setup_menu' );
add_filter( 'pt-ocdi/after_import', 'arr_merlin_setup_menu' );
function arr_merlin_setup_menu() {

	$top_menu = get_term_by( 'name', 'Top Menu', 'nav_menu' );

	set_theme_mod(
		'nav_menu_locations',
		array(
			'main_menu' => $top_menu->term_id,
		)
	);
}

/**
 * Setup Front/Blog Pages
 */
add_filter( 'merlin_after_all_import', 'arr_merlin_setup_front_blog_pages' );
add_filter( 'pt-ocdi/after_import', 'arr_merlin_setup_front_blog_pages' );
function arr_merlin_setup_front_blog_pages() {

	$front_page_id = get_page_by_title( 'Homepage 1' );
	$blog_page_id  = get_page_by_title( 'Blog' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );

}

/**
 * Setup Date Format
 */
add_filter( 'merlin_after_all_import', 'arr_merlin_setup_date_format' );
add_filter( 'pt-ocdi/after_import', 'arr_merlin_setup_date_format' );
function arr_merlin_setup_date_format() {

	update_option( 'date_format', 'd M Y' );

}

/**
 * Setup Intuitive Custom Post Order
 * Define sortable post types
 */
add_filter( 'merlin_after_all_import', 'arr_merlin_setup_hicpo' );
add_filter( 'pt-ocdi/after_import', 'arr_merlin_setup_hicpo' );
function arr_merlin_setup_hicpo() {
	add_option( 'hicpo_options', array( 'objects' ) );

	$hicpo_options = get_option( 'hicpo_options' );
	$hicpo_objects = $hicpo_options['objects'];

	// Sortable custom post types
	if ( ! $hicpo_objects ) {

		$hicpo_objects            = array( 'arr_portfolio', 'arr_services' );
		$hicpo_options['objects'] = $hicpo_objects;
		update_option( 'hicpo_options', $hicpo_options );

	} elseif ( ! in_array( 'arr_portfolio', $hicpo_objects ) ) {

		$hicpo_objects[]          = 'arr_portfolio';
		$hicpo_options['objects'] = $hicpo_objects;
		update_option( 'hicpo_options', $hicpo_options );

	} elseif ( ! in_array( 'arr_services', $hicpo_objects ) ) {

		$hicpo_objects[]          = 'arr_services';
		$hicpo_options['objects'] = $hicpo_objects;
		update_option( 'hicpo_options', $hicpo_objects );

	}
}

/**
 * Unset all widgets
 * from default blog sidebar
 */
add_action( 'merlin_widget_importer_before_widgets_import', 'arr_unset_default_sidebar_widgets' );
add_action( 'pt-ocdi/widget_importer_before_widgets_import', 'arr_unset_default_sidebar_widgets' );
function arr_unset_default_sidebar_widgets() {

	// empty default blog sidebar
	$widget_areas = array(
		'blog-sidebar' => array(),
	);
	update_option( 'sidebars_widgets', $widget_areas );

}
