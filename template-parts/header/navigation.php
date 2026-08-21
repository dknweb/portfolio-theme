<nav
	class="header-navigation"
	id="site-navigation"
	aria-label="<?php esc_attr_e( 'Primary navigation', 'portfolio-theme' ); ?>">

	<?php
	wp_nav_menu(
		[
			'theme_location' => 'primary',
			'container'      => false,
			'menu_class'     => 'primary-menu',
			'fallback_cb'    => false,
		]
	);
	?>

</nav>

