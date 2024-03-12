<?php

$priority = 1;

/**
 * Portfolio Custom Slug Option
 */
Kirki::add_field(
	'arrigo',
	array(
		'type'     => 'switch',
		'settings' => 'enable_custom_services_slug',
		'label'    => esc_html__( 'Enable custom services slug', 'arrigo' ),
		'section'  => 'services',
		'default'  => false,
		'priority' => $priority++,
	)
);

Kirki::add_field(
	'arrigo',
	array(
		'type'            => 'text',
		'settings'        => 'services_slug',
		'label'           => esc_html__( 'Services Slug', 'arrigo' ),
		'description'     => sprintf(
			'%1$s <a href="%2$s" target="_blank">%3$s</a> %4$s',
			esc_html__( 'Note: you will need to', 'arrigo' ),
			admin_url( 'options-permalink.php' ),
			esc_html__( 'update your permalinks', 'arrigo' ),
			esc_html__( 'each time you change the slug.', 'arrigo' )
		),
		'section'         => 'services',
		'default'         => esc_html__( 'services', 'arrigo' ),
		'priority'        => $priority++,
		'active_callback' => array(
			array(
				'setting'  => 'enable_custom_services_slug',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);
