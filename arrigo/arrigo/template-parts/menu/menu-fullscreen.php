<?php

$args_menu_fullscreen = array(
	'theme_location' => 'main_menu',
	'container'      => false,
	'menu_class'     => 'overlay-menu js-overlay-menu',
	'walker'         => new Arr_Nav_Menu_Walker(),
);

$has_lang_switcher = is_active_sidebar( 'lang-switcher-sidebar' );

?>

<div class="header__wrapper-overlay-menu" data-os-animation="data-os-animation">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-auto">
					<?php if ( $has_lang_switcher ) : ?>
						<div class="text-center header__lang-switcher d-xl-none">
							<?php dynamic_sidebar( 'lang-switcher-sidebar' ); ?>
						</div>
					<?php endif; ?>
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'main_menu',
								'container'      => false,
								'menu_class'     => 'overlay-menu js-overlay-menu',
								'walker'         => new Arr_Nav_Menu_Walker(),
							)
						);
						?>
				</div>
			</div>
		</div>
</div>
<div class="header__overlay-menu-back js-submenu-back fa fa-angle-up"></div>
<div class="col-auto">
	<?php if ( $has_lang_switcher ) : ?>
		<div class="d-xl-inline-block d-none">
			<?php dynamic_sidebar( 'lang-switcher-sidebar' ); ?>
		</div>
	<?php endif; ?>
	<div class="burger js-burger">
		<div class="burger__line"></div>
		<div class="burger__line"></div>
		<div class="burger__line"></div>
	</div>
</div>
