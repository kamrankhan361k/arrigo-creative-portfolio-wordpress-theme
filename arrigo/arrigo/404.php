<?php
$page_title    = get_theme_mod( '404_title', esc_html__( 'That page can\'t be found', 'arrigo' ) );
$page_subtitle = get_theme_mod( '404_message', esc_html__( 'It looks like nothing found at this location. Try to navigate the menu or go to the home page.', 'arrigo' ) );
$page_big      = get_theme_mod( '404_big', esc_html__( '404', 'arrigo' ) );
$page_button   = get_theme_mod( '404_button', esc_html__( 'Go to homepage', 'arrigo' ) );
?>

<?php get_header(); ?>

<!-- section 404 -->
<div class="container-fluid">
	<section class="section section-fullheight section-404">
		<div class="section-fullheight__inner section-404__inner bg-light">
			<div class="container">
				<div class="row justify-content-center align-items-center">
					<div class="col-lg-6">
						<div class="section-404__content">
							<h1><?php echo esc_html( $page_title ); ?></h1>
							<div class="section-404__text">
								<div class="section-404__headline"></div>
								<p><?php echo esc_html( $page_subtitle ); ?></p>
							</div>
							<div class="section-404__wrapper-button">
								<a class="button button_solid button_accent" href="<?php echo esc_url( home_url( '/' ) ); ?>">
									<span><?php echo esc_html( $page_button ); ?></span>
								</a>
							</div>
						</div>
						<div class="section-404__square"></div>
						<div class="section-404__box"></div>
						<div class="section-404__big"><?php echo esc_html( $page_big ); ?></div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<!-- - section 404 -->

<?php get_footer(); ?>
