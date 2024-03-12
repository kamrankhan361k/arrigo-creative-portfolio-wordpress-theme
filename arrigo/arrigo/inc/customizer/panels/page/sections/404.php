<?php

$priority = 1;

/**
 * 404 Preview Link
 */
Kirki::add_field(
	'arrigo',
	array(
		'type'     => 'generic',
		'settings' => '404_preview_link',
		'label'    => esc_attr__( 'Preview', 'arrigo' ),
		'section'  => '404',
		'priority' => $priority++,
		'default'  => esc_attr__( 'Load Page', 'arrigo' ),
		'choices'  => array(
			'element' => 'input',
			'type'    => 'button',
			'class'   => 'button button-secondary',
			'onclick' => 'javascript:wp.customize.previewer.previewUrl.set( "../not-found-" + String( Math.random() ) + "/" );',
		),
	)
);

/**
 * 404 Title
 */
Kirki::add_field(
	'arrigo',
	array(
		'type'      => 'text',
		'settings'  => '404_title',
		'label'     => __( 'Title', 'arrigo' ),
		'section'   => '404',
		'default'   => esc_attr__( 'That page can\'t be found', 'arrigo' ),
		'priority'  => $priority++,
		'transport' => 'postMessage',
	)
);

/**
 * 404 Message
 */
Kirki::add_field(
	'arrigo',
	array(
		'type'      => 'textarea',
		'settings'  => '404_message',
		'label'     => __( 'Message', 'arrigo' ),
		'section'   => '404',
		'default'   => esc_attr__( 'It looks like nothing found at this location. Try to navigate the menu or go to the home page.', 'arrigo' ),
		'priority'  => $priority++,
		'transport' => 'postMessage',
	)
);

/**
 * 404 Title
 */
Kirki::add_field(
	'arrigo',
	array(
		'type'      => 'text',
		'settings'  => '404_big',
		'label'     => __( 'Big Rotated Text', 'arrigo' ),
		'section'   => '404',
		'default'   => esc_attr__( '404', 'arrigo' ),
		'priority'  => $priority++,
		'transport' => 'postMessage',
	)
);

/**
 * 404 Button
 */
Kirki::add_field(
	'arrigo',
	array(
		'type'      => 'text',
		'settings'  => '404_button',
		'label'     => __( 'Button Text', 'arrigo' ),
		'section'   => '404',
		'default'   => esc_attr__( 'Go to Homepage', 'arrigo' ),
		'priority'  => $priority++,
		'transport' => 'postMessage',
	)
);
