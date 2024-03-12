<?php

/**
 * Custom Slug for Portfolio CPT
 */
add_filter( 'register_post_type_args', 'arr_change_cpt_slug_portfolio', 10, 2 );
function arr_change_cpt_slug_portfolio( $args, $post_type ) {
	$enabled = get_theme_mod( 'enable_custom_portfolio_slug', false );
	$slug    = get_theme_mod( 'portfolio_slug' );

	if ( $enabled && ! empty( $slug ) && $post_type == 'arr_portfolio' ) {
		$args['rewrite']['slug'] = $slug;
	}

	return $args;
}

/**
 * Custom Slug for Services CPT
 */
add_filter( 'register_post_type_args', 'arr_change_cpt_slug_services', 10, 2 );
function arr_change_cpt_slug_services( $args, $post_type ) {
	$enabled = get_theme_mod( 'enable_custom_services_slug', false );
	$slug    = get_theme_mod( 'services_slug' );

	if ( $enabled && ! empty( $slug ) && $post_type == 'arr_services' ) {
		$args['rewrite']['slug'] = $slug;
	}

	return $args;
}
