<?php

$priority = 1;

/**
 * Close Link
 */
Kirki::add_field(
	'arrigo',
	array(
		'type'        => 'link',
		'settings'    => 'portfolio_item_close_link',
		'label'       => esc_attr__( 'Close Button Link', 'arrigo' ),
		'description' => esc_attr__( 'This button is displayed if minimal header of portfolio item is chosen in Elementor -> Document Settings.', 'arrigo' ),
		'section'     => 'close',
		'priority'    => $priority++,
		'default'     => home_url( '/' ),
	)
);
