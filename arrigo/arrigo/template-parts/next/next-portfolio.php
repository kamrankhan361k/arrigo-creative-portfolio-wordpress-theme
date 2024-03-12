<?php

$show_next               = arr_get_document_option( 'portfolio_item_show_next' );
$portfolio_nav_direction = get_theme_mod( 'portfolio_nav_direction', 'backward' );

if ( ! $show_next ) {
	return;
}

$current_id = get_the_ID();
$next_id;
$prev_id;
$next_post;
$prev_post;

$args = array(
	'post_type'      => 'arr_portfolio',
	'posts_per_page' => -1,
);

$posts = get_posts( $args );

if ( $portfolio_nav_direction == 'backward' ) {

	$next_post  = get_next_post();
	$prev_post  = get_previous_post();
	$first_post = end( $posts );
	$last_post  = current( $posts );

} else {

	$next_post  = get_previous_post();
	$prev_post  = get_next_post();
	$first_post = current( $posts );
	$last_post  = end( $posts );

}

if ( $next_post ) {
	$next_id = $next_post->ID;
}

if ( $prev_post ) {
	$prev_id = $prev_post->ID;
}

if ( $next_post ) {

	$link  = get_permalink( $next_post );
	$title = $next_post->post_title;

} elseif ( $prev_post ) {

	$link  = get_permalink( $first_post );
	$title = $first_post->post_title;

}

?>

<?php if ( $next_post || $prev_post ) : ?>
	<!-- next -->
	<div class="portfolio-details__next">
		<aside class="aside aside-next">
			<div class="container-fluid">
				<a class="aside-next__inner" href="<?php echo esc_url( $link ); ?>">
					<div class="container">
						<div class="row">
							<div class="col">
								<div class="aside-next__content">
									<div class="aside-next__label"><?php echo _x( 'Next', 'Next Portfolio', 'arrigo' ); ?></div>
									<h3><?php echo esc_html( $title ); ?></h3>
									<div class="aside-next__wrapper-button">
										<div class="button-square">
											<?php get_template_part( 'template-parts/svg/svg-button' ); ?>
											<i class="lnr lnr-arrow-right"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
		</aside>
	</div>
	<!-- - next-->
<?php endif; ?>
