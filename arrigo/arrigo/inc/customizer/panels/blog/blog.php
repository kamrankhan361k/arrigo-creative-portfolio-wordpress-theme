<?php

$priority = 1;

/**
 * Section Post
 */
Kirki::add_section(
	'post',
	array(
		'title'    => esc_attr__( 'Post Display', 'arrigo' ),
		'priority' => $priority ++,
		'panel'    => 'blog',
	)
);
get_template_part( '/inc/customizer/panels/blog/sections/post' );

/**
 * Section Sidebar
 */
Kirki::add_section(
	'sidebar',
	array(
		'title'    => esc_attr__( 'Sidebar Display', 'arrigo' ),
		'priority' => $priority ++,
		'panel'    => 'blog',
	)
);
get_template_part( '/inc/customizer/panels/blog/sections/sidebar' );
