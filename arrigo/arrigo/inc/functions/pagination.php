<?php

/**
 * Custom class for pagination "Prev" button
 *
 * @return void
 */
add_filter( 'previous_posts_link_attributes', 'arr_filter_previous_posts_link_attributes', 10, 2 );
function arr_filter_previous_posts_link_attributes() {
	$attributes = 'class="page-numbers prev"';
	return $attributes;
}

/**
 * Custom class for pagination "Next" button
 *
 * @return void
 */
add_filter( 'next_posts_link_attributes', 'arr_filter_next_posts_link_attributes', 10, 2 );
function arr_filter_next_posts_link_attributes() {
	$attributes = 'class="page-numbers next"';
	return $attributes;
}

/**
 * Remove h2 heading from pagination
 * Remove default prev/next links and add custom ones
 * Add links container separated from prev/next links
 *
 * @return void
 */
function arr_posts_pagination( $args = array(), $class = 'pagination' ) {
	if ( $GLOBALS['wp_query']->max_num_pages <= 1 ) {
		return;
	}

	$args = wp_parse_args(
		$args,
		array(
			'prev_next'          => false, // hide default prev/next
			'prev_text'          => '',
			'next_text'          => '',
			'screen_reader_text' => __( 'Posts navigation', 'arrigo' ),
		)
	);

	$links     = paginate_links( $args );
	$prev_link = get_previous_posts_link( $args['prev_text'] );
	$next_link = get_next_posts_link( $args['next_text'] );
	$template  = apply_filters(
		'arr_navigation_markup_template',
		'
		<nav class="navigation %1$s" role="navigation">
			<div class="screen-reader-text d-none">%2$s</div>
				<div class="nav-links">
					%3$s
					<div class="nav-links__container">%4$s</div>
				%5$s
			</div>
		</nav>',
		$args,
		$class
	);

	echo sprintf( $template, $class, $args['screen_reader_text'], $prev_link, $links, $next_link );
}
