<?php

global $post;

$categories    = get_the_terms( $post->ID, 'arr_portfolio_category' );
$class_section = 'section_pb ';
$hide_section  = arr_get_document_option( 'hide_title' );

if ( $hide_section ) {
	$class_section .= 'd-none ';
}

?>

<section class="section section-masthead section_pt <?php echo esc_attr( $class_section ); ?>">
	<div class="container">
		<div class="row no-gutters">
			<div class="col">
				<?php if ( ! empty( $categories ) ) : ?>
					<div class="section-masthead__meta">
						<ul class="post-meta">
							<?php foreach ( $categories as $category ) : ?>
								<li><?php echo esc_html( $category->name ); ?></li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>
				<h1><?php the_title(); ?></h1>
			</div>
		</div>
	</div>
	<div class="section-masthead__line"></div>
</section>

