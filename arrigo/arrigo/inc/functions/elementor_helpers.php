<?php

/**
 * Wrapper for Plugin Function (Arrigo Plugin)
 * for Elementor
 */
if ( ! function_exists( 'arr_get_document_option' ) ) {
	function arr_get_document_option( $option, $post_id = null ) {
		if ( did_action( 'elementor/loaded' ) && function_exists( 'arr_elementor_get_document_option' ) ) {
			return arr_elementor_get_document_option( $option, $post_id );
		}
	}
}

/**
 * Check if Elementor "Improved Assets Loading" feature
 * is supported and active
 *
 * @return bool
 */
function arr_is_elementor_feature_active( $feature_name = '' ) {
	return class_exists( '\Elementor\Plugin' ) && isset( \Elementor\Plugin::instance()->experiments ) && \Elementor\Plugin::instance()->experiments->is_feature_active( $feature_name );
}
