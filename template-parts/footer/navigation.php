<?php
/**
 * Footer Navigation.
 *
 * @package PortfolioTheme
 */

$email      = portfolio_theme_get_email();
$phone      = portfolio_theme_get_phone();
$phone_href = portfolio_theme_get_phone_href();
$location   = portfolio_theme_get_location();
?>

<div class="footer-navigation">

	<div class="footer-navigation__group">

		<h4 class="footer-title">
			<?php esc_html_e( 'Quick Links', 'portfolio-theme' ); ?>
		</h4>

		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'quick-links',
				'container'      => false,
				'menu_class'     => 'footer-menu',
				'fallback_cb'    => false,
			)
		);
		?>

	</div>


	<div class="footer-navigation__group">

		<h4 class="footer-title">
			<?php esc_html_e( 'Services', 'portfolio-theme' ); ?>
		</h4>

		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'services',
				'container'      => false,
				'menu_class'     => 'footer-menu',
				'fallback_cb'    => false,
			)
		);
		?>

	</div>


	<div class="footer-navigation__group">

		<h4 class="footer-title">
			<?php esc_html_e( 'Get in touch', 'portfolio-theme' ); ?>
		</h4>

		<?php if ( $email || $phone || $location ) : ?>

			<ul class="footer-menu">

				<?php if ( $email ) : ?>
					<li>
						<a href="<?php echo esc_url( 'mailto:' . $email ); ?>">
							<?php echo esc_html( $email ); ?>
						</a>
					</li>
				<?php endif; ?>

				<?php if ( $phone && $phone_href ) : ?>
					<li>
						<a href="<?php echo esc_url( 'tel:' . $phone_href ); ?>">
							<?php echo esc_html( $phone ); ?>
						</a>
					</li>
				<?php endif; ?>

				<?php if ( $location ) : ?>
					<li>
						<?php echo esc_html( $location ); ?>
					</li>
				<?php endif; ?>

			</ul>

		<?php endif; ?>

	</div>

</div>