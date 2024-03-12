<?php

$page_preloader_settings = arr_get_document_option( 'page_preloader_settings' );
$curtains_num            = get_theme_mod( 'preloader_curtains_num', 4 );
$preloader_class         = get_theme_mod( 'preloader_style', 'preloader_light' );
$display_title_tagline   = get_theme_mod( 'header_text', true );
$has_custom_logo         = has_custom_logo();

if ( $page_preloader_settings ) {
	if ( arr_get_document_option( 'page_preloader_curtains_num' ) ) {
		$curtains_num = arr_get_document_option( 'page_preloader_curtains_num' )['size'];
	}

	if ( arr_get_document_option( 'page_preloader_style' ) ) {
		$preloader_class = arr_get_document_option( 'page_preloader_style' );
	}
}

?>

<div class="preloader <?php echo esc_attr( $preloader_class ); ?>">
	<?php for ( $i = 1; $i <= $curtains_num; $i++ ) : ?>
		<div class="preloader__curtain"></div>
	<?php endfor; ?>
	<?php if ( $display_title_tagline || $has_custom_logo ) : ?>
		<div class="preloader__wrapper-logo">
			<div class="preloader__logo">
				<?php get_template_part( 'template-parts/svg/svg', 'rect' ); ?>
				<?php get_template_part( 'template-parts/logo/logo' ); ?>
			</div>
		</div>
	<?php endif; ?>
</div>
