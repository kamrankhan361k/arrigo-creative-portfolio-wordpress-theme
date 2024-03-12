<?php if ( is_active_sidebar( 'blog-sidebar' ) ) : ?>
	<?php
		$class_sidebar = '';
	if ( arr_footer_has_active_sidebars() ) {
		$class_sidebar = 'sidebar_no-margin-last-widget';
	}
	?>
	<aside class="sidebar widget-area <?php echo esc_attr( $class_sidebar ); ?>">
		<?php	dynamic_sidebar( 'blog-sidebar' ); ?>
	</aside>
<?php endif; ?>
