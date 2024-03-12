<?php

$has_lang_switcher = is_active_sidebar( 'lang-switcher-sidebar' );

$wrapper_class = '';

if ( $has_lang_switcher ) {
	$wrapper_class = 'text-right lang-switch-no-padding-right';
}

$args_menu_regular = array(
	'theme_location' => 'main_menu',
	'container'      => $has_lang_switcher ? 'd-inline-block' : false,
);

$args_menu_fullscreen = array(
	'theme_location' => 'main_menu',
	'container'      => false,
	'menu_class'     => 'overlay-menu js-overlay-menu',
	'walker'         => new Arr_Nav_Menu_Walker(),
);

?>


<div class="col-auto d-xl-block d-none <?php echo esc_attr( $wrapper_class ); ?>">
	<?php wp_nav_menu( $args_menu_regular ); ?>
	<?php if ( $has_lang_switcher ) : ?>
		<?php dynamic_sidebar( 'lang-switcher-sidebar' ); ?>
	<?php endif; ?>
</div>
<div class="header__overlay-menu-back d-xl-none js-submenu-back fa fa-angle-up"></div>
<div class="header__wrapper-overlay-menu d-xl-none" data-os-animation="data-os-animation">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-auto">
				<?php if ( $has_lang_switcher ) : ?>
					<div class="text-center header__lang-switcher">
						<?php dynamic_sidebar( 'lang-switcher-sidebar' ); ?>
					</div>
				<?php endif; ?>
				<?php	wp_nav_menu( $args_menu_fullscreen ); ?>
			</div>
		</div>
	</div>
</div>
<div class="col-auto d-xl-none">
	<div class="burger js-burger">
		<div class="burger__line"></div>
		<div class="burger__line"></div>
		<div class="burger__line"></div>
	</div>
</div>
