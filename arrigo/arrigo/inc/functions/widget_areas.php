<?php

/**
 * Register Widget Areas
 *
 * @return void
 */
add_action( 'widgets_init', 'arr_register_widget_areas' );
function arr_register_widget_areas() {
	register_sidebar(
		array(
			'name'          => __( 'Blog Sidebar', 'arrigo' ),
			'id'            => 'blog-sidebar',
			'description'   => __( 'Appears in Blog.', 'arrigo' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
		)
	);

	$footer_columns = get_theme_mod( 'footer_columns', 3 );
	for ( $i = 1; $i <= $footer_columns; $i++ ) {
		register_sidebar(
			array(
				'name'          => sprintf( esc_html__( 'Footer %s Column', 'arrigo' ), $i ),
				'id'            => 'footer-sidebar-' . $i,
				'description'   => __( 'Appears in Page Footer.', 'arrigo' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
			)
		);
	}

	if ( class_exists( 'SitePress' ) || class_exists( 'Polylang' ) || class_exists( 'TRP_Translate_Press' ) ) {
		register_sidebar(
			array(
				'name'          => __( 'Language Switcher Area', 'arrigo' ),
				'id'            => 'lang-switcher-sidebar',
				'description'   => __( 'Appears in the top menu.', 'arrigo' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
			)
		);
	}
}

