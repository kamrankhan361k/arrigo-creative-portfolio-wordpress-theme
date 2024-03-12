<?php

$class_section  = '';
$hide_section   = arr_get_document_option( 'hide_title' );
$post_show_info = get_theme_mod( 'post_show_info', true );

if ( ! has_post_thumbnail() ) {
	$class_section = 'section_mb bg-light ';
}

if ( $hide_section ) {
	$class_section .= 'd-none ';
}

?>

<section class="section section-masthead section_pt section_pb <?php echo esc_attr( $class_section ); ?>">
	<div class="container">
		<div class="row">
			<div class="col">
				<?php if ( $post_show_info ) : ?>
					<div class="section-masthead__meta">
						<?php get_template_part( 'template-parts/post/partials/post_info' ); ?>
					</div>
				<?php endif; ?>
				<h1><?php the_title(); ?></h1>
			</div>
		</div>
	</div>
	<div class="section-masthead__line"></div>
</section>

<?php if ( has_post_thumbnail() ) : ?>
	<!-- post featured img -->
	<div class="container-fluid">
		<div class="row text-center">
			<div class="col">
				<?php the_post_thumbnail(); ?>
			</div>
		</div>
	</div>
	<!-- - post featured img -->
<?php endif; ?>
