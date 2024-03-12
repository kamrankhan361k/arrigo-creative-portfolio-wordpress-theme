<?php

/**
 * Theme Constants
 */
$theme         = wp_get_theme();
$theme_version = $theme->get( 'Version' );

// Try to get the parent theme object
$theme_parent = $theme->parent();

// Set current theme version as parent not child
if ( $theme_parent ) {
	$theme_version = $theme_parent->Version;
}

define( 'ARR_THEME_SLUG', 'arrigo' );
define( 'ARR_THEME_PATH', get_template_directory() );
define( 'ARR_THEME_URL', get_template_directory_uri() );
define( 'ARR_THEME_PLUGINS_REMOTE_SOURCE', true );
define( 'ARR_THEME_VERSION', $theme_version );

/**
* ACF Helper Functions
*/
require_once ARR_THEME_PATH . '/inc/functions/acf_helpers.php';

/**
* ACF Fields
*/
require_once ARR_THEME_PATH . '/inc/functions/acf.php';

/**
 * Add Custom Icons to Elementor
 */
require_once ARR_THEME_PATH . '/inc/functions/add_elementor_icons.php';

/**
 * Add a Pingback Url to Posts
 */
require_once ARR_THEME_PATH . '/inc/functions/add_pingback_url.php';

/**
 * Custom CPT slugs
 */
require_once ARR_THEME_PATH . '/inc/functions/change_cpt_slug.php';

/**
 * Comments Form
 */
require_once ARR_THEME_PATH . '/inc/functions/comments.php';

/**
* Allow to upload some custom files
*/
require_once ARR_THEME_PATH . '/inc/functions/custom_mime_types.php';

/**
 * Elementor Compatibility Functions
 */
require_once ARR_THEME_PATH . '/inc/functions/elementor_compatibility.php';

/**
 * Helper Functions (Elementor)
 */
require_once ARR_THEME_PATH . '/inc/functions/elementor_helpers.php';

/**
* Adobe Typekit & custom fonts support
*/
require_once ARR_THEME_PATH . '/inc/functions/fonts.php';

/**
 * Customizer Options (Kirki)
 */
require_once ARR_THEME_PATH . '/inc/customizer/customizer.php';

/**
 * Check If Footer Has Active Sidebars
 */
require_once ARR_THEME_PATH . '/inc/functions/footer_has_active_sidebars.php';

/**
 * Frontend Styles & Scripts
 */
require_once ARR_THEME_PATH . '/inc/functions/frontend.php';

/**
 * Get Post Author
 */
require_once ARR_THEME_PATH . '/inc/functions/get_post_author.php';

/**
 * hex2rgb
 */
require_once ARR_THEME_PATH . '/inc/functions/hex2rgb.php';

/**
 * Elementor check
 */
require_once ARR_THEME_PATH . '/inc/functions/is_built_with_elementor.php';

/**
 * Load Required Plugins
 */
require_once ARR_THEME_PATH . '/inc/functions/load_plugins.php';

/**
 * Merlin WP
 * Only only if One Click Demo Import plugin
 * is not activated
 */
if ( ! class_exists( 'OCDI_Plugin' ) ) {
	require_once ARR_THEME_PATH . '/inc/merlin/vendor/autoload.php';
	require_once ARR_THEME_PATH . '/inc/merlin/class-merlin.php';
	require_once ARR_THEME_PATH . '/inc/merlin/merlin-config.php';
}
require_once ARR_THEME_PATH . '/inc/merlin/merlin-filters.php';

/**
 * Nav Menu
 */
require_once ARR_THEME_PATH . '/inc/functions/nav.php';

/**
 * Pagination for Posts
 */
require_once ARR_THEME_PATH . '/inc/functions/pagination.php';

/**
 * Password Form for Protected Posts
 */
require_once ARR_THEME_PATH . '/inc/functions/password_form.php';

/**
 * Markup for lazy images & backgrounds
 */
require_once ARR_THEME_PATH . '/inc/functions/the_lazy_image.php';

/**
 * Theme Support Features
 */
require_once ARR_THEME_PATH . '/inc/functions/theme_support.php';

/**
 * Widget Areas
 */
require_once ARR_THEME_PATH . '/inc/functions/widget_areas.php';

/**
 * Wrap Post Count in Widgets (categories, archives) into <span> Tag
 */
require_once ARR_THEME_PATH . '/inc/functions/wrap-count.php';

/**
 * WP Contact Form 7: Don't Wrap Form Fields Into </p>
 */
require_once ARR_THEME_PATH . '/inc/functions/wpcf7.php';

/**
 * Remove rendering of SVG duotone filters
 */
require_once ARR_THEME_PATH . '/inc/functions/remove_duotone_filters.php';
