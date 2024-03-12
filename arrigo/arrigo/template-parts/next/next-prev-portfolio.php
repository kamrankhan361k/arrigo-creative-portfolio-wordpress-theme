<?php

$show_next = arr_get_document_option( 'portfolio_item_show_next' );

if ( ! $show_next ) {
	return;
}

$current_id = get_the_ID();
$next_post  = get_previous_post();
$prev_post  = get_next_post();
$next_link;
$next_title;
$prev_link;
$prev_title;

$args = array(
	'post_type'      => 'arr_portfolio',
	'posts_per_page' => -1,
);

$posts = get_posts( $args );

$first_post = current( $posts );
$last_post  = end( $posts );

if ( $next_post ) {
	$next_link  = get_permalink( $next_post );
	$next_title = $next_post->post_title;
} else {
	$next_link  = get_permalink( $first_post );
	$next_title = $first_post->post_title;
}

if ( $prev_post ) {
	$prev_link  = get_permalink( $prev_post );
	$prev_title = $prev_post->post_title;
} else {
	$prev_link  = get_permalink( $last_post );
	$prev_title = $last_post->post_title;
}

?>

<?php if ( $next_post || $prev_post ) : ?>
	<div class="portfolio-details__next">
		<aside class="aside aside-next">
			<div class="container-fluid position-relative">
				<div class="row">
					<div class="col-lg-6 order-lg-2">
						<a class="aside-next__inner" href="<?php echo esc_url( $next_link ); ?>">
							<div class="container">
								<div class="row">
									<div class="col">
										<div class="aside-next__content">
											<div class="aside-next__label"><?php echo _x( 'Next', 'Next Portfolio', 'arrigo' ); ?></div>
											<h3><?php echo esc_html( $next_title ); ?></h3>
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
					<div class="aside-next__divider"></div>
					<div class="col-lg-6 order-lg-1">
						<a class="aside-next__inner" href="<?php echo esc_url( $prev_link ); ?>">
							<div class="container">
								<div class="row">
									<div class="col">
										<div class="aside-next__content">
											<div class="aside-next__label"><?php echo _x( 'Previous', 'Next Portfolio', 'arrigo' ); ?></div>
											<h3><?php echo esc_html( $prev_title ); ?></h3>
											<div class="aside-next__wrapper-button">
												<div class="button-square">
													<?php get_template_part( 'template-parts/svg/svg-button' ); ?>
													<i class="lnr lnr-arrow-left"></i>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</aside>
	</div>
<?php endif; ?>
