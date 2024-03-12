<?php

$footer_columns       = get_theme_mod( 'footer_columns', 3 );
$page_footer_settings = arr_get_document_option( 'page_footer_settings' );
$footer_hide          = false;

$class_row = 'align-items-center';
$class_col = '';

switch ( $footer_columns ) {
	case 1: {
		$class_col = 'col text-center';
		break;
	}
	case 2: {
		$class_col = 'col-lg-6';
		break;
	}
	case 3: {
		$class_col = 'col-lg-4';
		break;
	}
	default: {
		$class_col = 'col-lg-3';
		$class_row = '';
		break;
	}
}

/**
 * Use Individual Page Footer Settings from Elementor
 * Or Use Global Settings from Customizer
 */
if ( $page_footer_settings ) {

	if ( arr_get_document_option( 'page_footer_hide' ) ) {
		$footer_hide = true;
	}
}

?>
			<canvas id="js-webgl"></canvas>
		</main>
	<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) : ?>
		<?php if ( arr_footer_has_active_sidebars() && ! $footer_hide ) : ?>
			<footer class="footer">
				<div class="container-fluid">
					<div class="footer__inner">
						<div class="row <?php echo esc_attr( $class_row ); ?>">
							<?php for ( $i = 1; $i <= $footer_columns; $i++ ) : ?>
								<?php

								if ( is_active_sidebar( 'footer-sidebar-' . $i ) ) {

									$class_col_order = ' order-lg-' . $i;
									if ( $footer_columns == 2 && $i == 1 ) {
										$class_col = 'col-lg-6 text-left';
									}
									if ( $footer_columns == 2 && $i == 2 ) {
										$class_col = 'col-lg-6 text-right';
									}
									if ( $footer_columns == 3 && $i == 1 ) {
										$class_col = 'col-lg-4 text-left';
									}
									if ( $footer_columns == 3 && $i == 2 ) {
										$class_col = 'col-lg-4 text-center';
									}
									if ( $footer_columns == 3 && $i == 3 ) {
										$class_col = 'col-lg-4 text-right';
									}
									if ( get_theme_mod( 'order_column_' . $i ) > 1 ) {
										$order           = get_theme_mod( 'order_column_' . $i );
										$class_col_order = ' order-lg-' . $i . ' order-' . $order;
									}
									?>
								<div class="<?php echo esc_attr( $class_col . $class_col_order ); ?> footer__column">
									<?php dynamic_sidebar( 'footer-sidebar-' . $i ); ?>
								</div>
								<?php } ?>
							<?php endfor; ?>
						</div>
					</div>
				</div>
			</footer>
		<?php endif; ?>
	<?php endif; ?>
</div><!-- - page-wrapper -->

<?php wp_footer(); ?>
</body>
</html>
