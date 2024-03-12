<?php

$is_elementor_page = arr_is_built_with_elementor();

get_header();
get_template_part( 'template-parts/masthead/masthead' );
the_post();

?>

<?php if ( ! $is_elementor_page ) : ?>
	<section class="section section_mt section_mb-small section-blog">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col">
					<div class="post">
						<div class="post__content clearfix">
							<?php the_content(); ?>
						</div>
						<?php
							wp_link_pages(
								array(
									'before'      => '<div class="page-links">' . __( 'Pages:', 'arrigo' ),
									'after'       => '</div>',
									'link_before' => '<span class="page-number">',
									'link_after'  => '</span>',
								)
							);
						?>
						<!-- .post__content -->
						<?php if ( comments_open() || get_comments_number() ) : ?>
							<div class="post__comments">
								<?php comments_template(); ?>
							</div>
							<!-- .post__comments -->
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php else : ?>
	<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single-page' ) ) : // Elementor "page" location ?>
		<?php the_content(); ?>
	<?php endif; ?>
<?php endif; ?>

<?php
	get_footer();
