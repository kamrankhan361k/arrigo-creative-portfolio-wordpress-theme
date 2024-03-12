<?php

$page_title            = '';
$page_subtitle         = '';
$class_section         = '';
$attrs_section         = '';
$hide_section          = arr_get_document_option( 'hide_title' );
$enable_masthead_image = get_theme_mod( 'enable_masthead_image', false );
$has_post_thumbnail    = has_post_thumbnail();
$enable_overlay        = false;

if ( is_category() ) {

	$page_title    = get_category( get_query_var( 'cat' ) )->name;
	$page_subtitle = __( 'Posts in category', 'arrigo' );

} elseif ( is_author() ) {

	$page_title    = get_userdata( get_query_var( 'author' ) )->display_name;
	$page_subtitle = __( 'Posts by author', 'arrigo' );

} elseif ( is_tag() ) {

	$page_title    = single_tag_title( '', false );
	$page_subtitle = __( 'Posts with tag', 'arrigo' );

} elseif ( is_day() ) {

	$page_title    = get_the_date();
	$page_subtitle = __( 'Day archive', 'arrigo' );

} elseif ( is_month() ) {

	$page_title    = get_the_date( 'F Y' );
	$page_subtitle = __( 'Month archive', 'arrigo' );

} elseif ( is_year() ) {

	$page_title    = get_the_date( 'Y' );
	$page_subtitle = __( 'Year archive', 'arrigo' );

} elseif ( is_home() ) {

	$page_title = wp_title( '', false );

} elseif ( is_search() ) {

	$default_title = __( 'Search', 'arrigo' );
	$page_title    = get_theme_mod( 'search_title', $default_title );

} else {

	$page_title    = get_the_title();
	$page_subtitle = '';

}

if ( ! $page_title ) {
	$page_title = __( 'Blog', 'arrigo' );
}

if ( $hide_section ) {
	$class_section .= 'd-none ';
}

if ( $enable_masthead_image && $has_post_thumbnail && is_singular() ) {
	$class_section .= 'section-masthead_background';
	$attrs_section .= 'background-image: url(' . get_the_post_thumbnail_url() . '); ';
	$enable_overlay = true;
}

?>

<section class="section section-masthead section_mb section_pt section_pb bg-light <?php echo esc_attr( $class_section ); ?>" style="<?php echo esc_attr( $attrs_section ); ?>">
	<div class="container">
		<div class="row">
			<div class="col">
				<?php if ( $page_subtitle ) : ?>
					<div class="section-masthead__meta">
						<ul class="post-meta">
							<li><?php echo esc_html( $page_subtitle ); ?></li>
						</ul>
					</div>
				<?php endif; ?>
				<?php if ( $page_title ) : ?>
					<h1><?php echo esc_html( $page_title ); ?></h1>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="section-masthead__line"></div>
	<?php if ( $enable_overlay ) : ?>
		<div class="overlay overlay_dark section-masthead__overlay"></div>
	<?php endif; ?>
</section>
