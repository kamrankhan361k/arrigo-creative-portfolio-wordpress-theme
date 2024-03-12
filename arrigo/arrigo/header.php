<?php

$menu_style                = get_theme_mod( 'menu_style', 'regular' );
$show_preloader            = false;
$portfolio_item_close_link = get_theme_mod( 'portfolio_item_close_link', home_url( '/' ) );
$page_header_settings      = arr_get_document_option( 'page_header_settings' );
$page_preloader_settings   = arr_get_document_option( 'page_preloader_settings' );
$header_class              = '';
$row_class                 = 'justify-content-between';
$minimal_header            = '';
$has_menu                  = has_nav_menu( 'main_menu' );
$display_title_tagline     = get_theme_mod( 'header_text', true );
$has_custom_logo           = has_custom_logo();
$has_lang_switcher         = is_active_sidebar( 'lang-switcher-sidebar' );
$outdated_browsers_enabled = get_theme_mod( 'outdated_browsers_enabled', true );

/**
 * Use Individual Page Header Settings from Elementor
 * Or Use Global Settings from Customizer
 */
if ( $page_header_settings ) {

	$page_header_theme        = arr_get_document_option( 'page_header_theme' );
	$page_header_position     = arr_get_document_option( 'page_header_position' );
	$page_header_sticky       = arr_get_document_option( 'page_header_sticky' );
	$page_menu_style          = arr_get_document_option( 'page_menu_style' );
	$page_header_logo_version = arr_get_document_option( 'page_header_logo_version' );
	$minimal_header           = arr_get_document_option( 'page_header_minimal' );

	if ( $page_header_theme ) {
		$header_class .= $page_header_theme . ' ';
	}

	if ( $page_header_position ) {
		$header_class .= $page_header_position . ' ';
	}

	if ( $page_header_sticky ) {
		$header_class .= 'js-header-sticky ';
	}

	if ( $page_menu_style ) {
		$menu_style = $page_menu_style;
	}

	if ( $page_header_logo_version === 'alt' ) {
		$header_class .= 'd-logo-alt ';
	}

	/**
	 * Check if header is minimal on this page or post
	 * (only close button will be displayed)
	 * Used on Portfolio Items post types
	 */
	if ( $minimal_header ) {
		// $row_class    = '';
		$header_class = 'header_fixed';
	}
} else {

	if ( get_theme_mod( 'header_sticky', true ) ) {
		$header_class .= 'js-header-sticky ';
	}

	if ( get_theme_mod( 'header_position', 'header_absolute' ) ) {
		$header_class .= get_theme_mod( 'header_position', 'header_absolute' ) . ' ';
	}

	if ( get_theme_mod( 'header_theme', 'header_light' ) ) {
		$header_class .= get_theme_mod( 'header_theme', 'header_light' ) . ' ';
	}

	if ( get_theme_mod( 'header_logo_version' ) === 'alt' ) {
		$header_class .= 'd-logo-alt ';
	}
}

/**
 * Preloader Type
 */
if ( get_theme_mod( 'preloader_type', 'more' ) == 'curtains' ) {

	$show_preloader = true;

}

/**
 * Use Individual Page Preloader Settings from Elementor
 * Or Use Global Settings from Customizer
 */
if ( $page_preloader_settings ) {

	if ( arr_get_document_option( 'page_preloader_type' ) == 'curtains' ) {
		$show_preloader = true;
	} else {
		$show_preloader = false;
	}
}

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	}
	?>
	<?php if ( $outdated_browsers_enabled ) : ?>
		<div id="outdated"></div>
	<?php endif; ?>
	<?php if ( $show_preloader ) : ?>
		<!-- PAGE PRELOADER -->
		<?php get_template_part( 'template-parts/preloader/preloader' ); ?>
		<!-- - PAGE PRELOADER -->
	<?php endif; ?>

	<div class="page-wrapper page-wrapper_hidden">

		<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) : ?>
			<?php if ( $has_menu || $display_title_tagline || $has_custom_logo || $has_lang_switcher ) : ?>
				<!-- PAGE HEADER -->
				<header class="header <?php echo esc_attr( $header_class ); ?>">
					<div class="container-fluid">
						<div class="row align-items-center <?php echo esc_attr( $row_class ); ?>">
							<?php if ( ! $minimal_header ) : ?>
								<div class="col-auto">
									<?php get_template_part( 'template-parts/logo/logo' ); ?>
								</div>
								<?php if ( has_nav_menu( 'main_menu' ) ) : ?>
									<?php if ( $menu_style == 'regular' ) : ?>
										<?php get_template_part( 'template-parts/menu/menu' ); ?>
									<?php elseif ( $menu_style == 'fullscreen' ) : ?>
										<?php get_template_part( 'template-parts/menu/menu-fullscreen' ); ?>
									<?php endif; ?>
								<?php endif; ?>
							<?php else : ?>
								<div class="col-auto">
									<a class="button-close" href="<?php echo esc_url( $portfolio_item_close_link ); ?>">
										<div class="button-close__line"></div>
										<div class="button-close__line"></div>
									</a>
								</div>
								<?php if ( $has_lang_switcher ) : ?>
									<div class="col-auto">
										<?php dynamic_sidebar( 'lang-switcher-sidebar' ); ?>
									</div>
								<?php endif; ?>
							<?php endif; ?>
						</div>
					</div>
				</header>
				<!-- - PAGE HEADER -->
			<?php endif; ?>
		<?php endif; ?>

		<!-- PAGE MAIN -->
		<main class="page-main">
