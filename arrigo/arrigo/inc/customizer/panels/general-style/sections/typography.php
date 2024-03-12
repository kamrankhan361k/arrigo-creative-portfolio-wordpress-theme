<?php

$priority = 1;

$variant_primary = array(
	'300',
	'300italic',
	'regular',
	'italic',
	'600',
	'600italic',
);

$variant_secondary = array(
	'regular',
	'italic',
	'700',
	'700italic',
);

$choices_primary   = arr_add_custom_choice();
$choices_secondary = arr_add_custom_choice();

$choices_primary['variant']   = $variant_primary;
$choices_secondary['variant'] = $variant_secondary;

/**
 * Primary Font
 */
Kirki::add_field(
	'arrigo',
	array(
		'type'        => 'typography',
		'settings'    => 'font_primary',
		'label'       => esc_html__( 'Primary Font', 'arrigo' ),
		'description' => esc_html__( 'Used thoughout the theme. Size will be adjusted only for paragraph text.', 'arrigo' ),
		'section'     => 'typography',
		'default'     => array(
			'font-family' => 'Poppins',
			'font-size'   => '14px',
			'line-height' => '1.71',
		),
		'priority'    => $priority++,
		'choices'     => $choices_primary,
		'output'      => array(
			array(
				'element' => 'body',
			),
		),
	)
);

/**
 * Secondary Font
 */
Kirki::add_field(
	'arrigo',
	array(
		'type'        => 'typography',
		'settings'    => 'font_secondary',
		'label'       => esc_html__( 'Secondary Font', 'arrigo' ),
		'description' => esc_html__( 'Used only for text logo styling.', 'arrigo' ),
		'section'     => 'typography',
		'default'     => array(
			'font-family' => 'Playfair Display',
			'font-size'   => '20px',
			'variant'     => 'italic',
			'line-height' => '1.71',
		),
		'priority'    => $priority++,
		'choices'     => $choices_secondary,
		'output'      => array(
			array(
				'element' => '.logo__text-title',
			),
		),
	)
);

/**
 * Force Load All Fonts Variations
 */
Kirki::add_field(
	'arrigo',
	array(
		'type'        => 'switch',
		'settings'    => 'force_load_all_fonts_variations',
		'label'       => esc_html__( 'Force Load All Selected Fonts Variations', 'arrigo' ),
		'description' => esc_html__( 'Please also note that this may significantly decrease site loading speed if your font contains a lot of weights & styles.', 'arrigo' ),
		'section'     => 'typography',
		'default'     => false,
		'priority'    => $priority++,
	)
);
