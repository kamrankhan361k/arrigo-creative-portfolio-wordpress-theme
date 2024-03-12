<?php

/**
 * Check if the current post/page
 * is built using Elementor
 *
 * @param string $post_id
 * @return bool
 */
if ( ! function_exists( 'arr_is_built_with_elementor' ) ) {
	function arr_is_built_with_elementor( $post_id = null ) {
		if ( ! class_exists( '\Elementor\Plugin' ) ) {
			return false;
		}

		// blog page
		if ( is_home() ) {
			$post_id = get_option( 'page_for_posts' );
		}

		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}

		if ( is_singular() && \Elementor\Plugin::$instance->documents->get( $post_id ) && \Elementor\Plugin::$instance->documents->get( $post_id )->is_built_with_elementor() ) {
			return true;
		}

		return false;
	}
}
