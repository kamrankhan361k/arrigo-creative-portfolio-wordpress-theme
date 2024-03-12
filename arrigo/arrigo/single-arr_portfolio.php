<?php
	get_header();

	$color_theme = arr_get_document_option( 'portfolio_item_color_theme' );
	$nav_style   = get_theme_mod( 'portfolio_nav_style', 'next' );
?>

<div class="portfolio-details <?php echo esc_attr( $color_theme ); ?>">
	<?php
		get_template_part( 'template-parts/masthead/masthead', 'portfolio' );
		the_post();
		the_content();
		get_template_part( 'template-parts/next/' . esc_attr( $nav_style ), 'portfolio' );
	?>
</div>

<?php
	get_footer();
?>
