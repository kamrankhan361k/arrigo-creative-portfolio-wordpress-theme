<?php

/**
 * Enqueue Theme CSS Files
 */
add_action( 'wp_enqueue_scripts', 'arr_enqueue_styles', 20 );
function arr_enqueue_styles() {
	$enable_cf_7_modals = get_theme_mod( 'enable_cf_7_modals', true );

	// fallback font if Kirki is not loaded
	if ( ! class_exists( 'Kirki' ) ) {
		wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,600,600i|Playfair Display:400,400i,700,700i', array(), null );
	}

	if ( ! arr_is_elementor_feature_active( 'e_optimized_assets_loading' ) ) {
		wp_enqueue_style( 'swiper', ARR_THEME_URL . '/css/swiper.min.css', array(), '4.4.6' );
	}

	wp_enqueue_style( 'bootstrap-reboot', ARR_THEME_URL . '/css/bootstrap-reboot.min.css', array(), '4.1.3' );
	wp_enqueue_style( 'bootstrap-grid', ARR_THEME_URL . '/css/bootstrap-grid.min.css', array(), '4.1.3' );
	wp_enqueue_style( 'font-awesome', ARR_THEME_URL . '/css/font-awesome.min.css', array(), '4.7.0' );
	wp_enqueue_style( 'linear-icons', ARR_THEME_URL . '/css/linear-icons.min.css', array(), '1.0.0' );
	wp_enqueue_style( 'arrigo-main-style', ARR_THEME_URL . '/css/main.css', array(), ARR_THEME_VERSION );
	wp_enqueue_style( 'arrigo-theme-style', ARR_THEME_URL . '/style.css', array(), ARR_THEME_VERSION );

		// hide default Contact Form 7 response boxes if custom modals are enabled
	if ( $enable_cf_7_modals ) {
		wp_enqueue_script( 'bootstrap-modal', ARR_THEME_URL . '/js/bootstrap-modal.min.js', array( 'jquery', 'bootstrap-util' ), '4.1.3', true );
		wp_enqueue_script( 'bootstrap-util', ARR_THEME_URL . '/js/bootstrap-util.min.js', array( 'jquery' ), '4.1.3', true );
		wp_add_inline_style( 'contact-form-7', trim( '.wpcf7-mail-sent-ok, .wpcf7 form.sent .wpcf7-response-output, .wpcf7-mail-sent-ng, .wpcf7 form.failed .wpcf7-response-output { display: none !important; }' ) );
	}
}

/**
 * Inline Colors from Customizer
 */
add_action( 'wp_enqueue_scripts', 'arr_inline_css', 30 );
function arr_inline_css() {
	$color_accent_primary   = get_theme_mod( 'color_accent_primary', '#b68c70' );
	$color_accent_secondary = get_theme_mod( 'color_accent_secondary', '#9b724d' );

	$color_accent_primary_rgb   = arr_hex2rgb( $color_accent_primary );
	$color_accent_secondary_rgb = arr_hex2rgb( $color_accent_secondary );

	$css = "
		:root {
			--color-accent-primary: {$color_accent_primary};
			--color-accent-secondary: {$color_accent_secondary};
			--color-accent-primary-rgb: {$color_accent_primary_rgb['red']}, {$color_accent_primary_rgb['green']}, {$color_accent_primary_rgb['blue']};
			--color-accent-secondary-rgb: {$color_accent_secondary_rgb['red']}, {$color_accent_secondary_rgb['green']}, {$color_accent_secondary_rgb['blue']};
		}
	";
	wp_add_inline_style( 'arrigo-main-style', trim( $css ) );
}

/**
 * Enqueue Modernizr & Polyfills
 */
add_action( 'wp_enqueue_scripts', 'arr_enqueue_polyfills', 20 );
function arr_enqueue_polyfills() {
	$outdated_browsers_enabled = get_theme_mod( 'outdated_browsers_enabled', false );

	if ( $outdated_browsers_enabled ) {
		wp_enqueue_script( 'outdated-browser-rework', ARR_THEME_URL . '/js/outdated-browser-rework.min.js', array(), '1.1.0', false );
	}

	wp_enqueue_script( 'modernizr', ARR_THEME_URL . '/js/modernizr.custom.min.js', array(), '3.6.0', false );
}

/**
 * Enqueue Theme JS Files
 */
add_action( 'wp_enqueue_scripts', 'arr_enqueue_scripts', 50 );
function arr_enqueue_scripts() {
	if ( is_singular() && comments_open() ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( ! arr_is_elementor_feature_active( 'e_optimized_assets_loading' ) ) {
		wp_enqueue_script( 'swiper', ARR_THEME_URL . '/js/swiper.min.js', array(), '4.4.6', true );
	}

	wp_enqueue_script( 'imagesloaded' );
	wp_enqueue_script( 'animation-gsap', ARR_THEME_URL . '/js/animation.gsap.min.js', array( 'scrollmagic', 'gsap' ), '2.0.8', true );
	wp_enqueue_script( 'drawsvg-plugin', ARR_THEME_URL . '/js/DrawSVGPlugin.min.js', array( 'gsap' ), '3.11.4', true );
	wp_enqueue_script( 'jarallax', ARR_THEME_URL . '/js/jarallax.min.js', array( 'jquery' ), '1.10.5', true );
	wp_enqueue_script( 'jquery-scrollmagic', ARR_THEME_URL . '/js/jquery.ScrollMagic.min.js', array( 'scrollmagic' ), '2.0.8', true );
	wp_enqueue_script( 'scrollmagic', ARR_THEME_URL . '/js/ScrollMagic.min.js', array(), '2.0.8', true );
	wp_enqueue_script( 'split-text', ARR_THEME_URL . '/js/SplitText.min.js', array(), '3.11.4', true );
	wp_enqueue_script( 'gsap', ARR_THEME_URL . '/js/gsap.min.js', array(), '3.11.4', true );
	wp_enqueue_script( 'isotope', ARR_THEME_URL . '/js/isotope.pkgd.min.js', array(), '3.0.6', true );
	wp_enqueue_script( 'jquery-lazy', ARR_THEME_URL . '/js/jquery.lazy.min.js', array( 'jquery' ), '1.7.10', true );
	wp_enqueue_script( 'jquery-lazy-plugins', ARR_THEME_URL . '/js/jquery.lazy.plugins.min.js', array( 'jquery', 'jquery-lazy' ), '1.7.10', true );
	wp_enqueue_script( 'arrigo-components', ARR_THEME_URL . '/js/components.js', array( 'modernizr', 'jquery', 'isotope', 'imagesloaded', 'jarallax' ), ARR_THEME_VERSION, true );
}

/**
 * Localize Theme Options
 */
add_action( 'wp_enqueue_scripts', 'arr_localize_data', 60 );
function arr_localize_data() {
	$color_accent_primary   = get_theme_mod( 'color_accent_primary', '#b68c70' );
	$color_accent_secondary = get_theme_mod( 'color_accent_secondary', '#9b724d' );
	$typography_primary     = get_theme_mod( 'font_primary', array( 'font-family' => 'Poppins' ) );
	$typography_secondary   = get_theme_mod( 'font_secondary', array( 'font-family' => 'Playfair Display' ) );
	$enable_cf_7_modals     = get_theme_mod( 'enable_cf_7_modals', true );

	wp_localize_script(
		'arrigo-components',
		'theme',
		array(
			'themeURL'     => esc_js( ARR_THEME_URL ),
			'colors'       => array(
				'accentPrimary'   => $color_accent_primary,
				'accentSecondary' => $color_accent_secondary,
			),
			'typography'   => array(
				'fontPrimary'   => $typography_primary['font-family'],
				'fontSecondary' => $typography_secondary['font-family'],
			),
			'contactForm7' => array(
				'customModals' => esc_js( $enable_cf_7_modals ),
			),
		)
	);
}

/**
 * Enqueue Customizer Live Preview Script
 */
add_action( 'customize_preview_init', 'arr_customize_preview_script' );
function arr_customize_preview_script() {
	wp_enqueue_script( 'arrigo-customizer-preview', ARR_THEME_URL . '/js/customizer.min.js', array(), ARR_THEME_VERSION, true );
}

/**
 * Exclude certain JS from the aggregation
 * function of Autoptimize plugin
 */
add_filter( 'autoptimize_filter_js_exclude', 'arr_ao_override_jsexclude', 10, 1 );
/**
 * JS optimization exclude strings, as configured in admin page.
 *
 * @param $exclude: comma-seperated list of exclude strings
 * @return: comma-seperated list of exclude strings
 */
function arr_ao_override_jsexclude( $exclude ) {
	return $exclude . ', outdated-browser-rework';
}
