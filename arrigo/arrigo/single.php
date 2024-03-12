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
					</div>
				</div>
			</div>
		</div>
	</section>
<?php else : ?>
	<?php the_content(); ?>
<?php endif; ?>

<?php
	get_footer();
