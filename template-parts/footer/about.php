<?php
/**
 * Footer About.
 *
 * @package PortfolioTheme
 */

$linkedin = portfolio_theme_get_social_url( 'linkedin' );
$github   = portfolio_theme_get_social_url( 'github' );
$email    = portfolio_theme_get_email();
?>

<div class="footer-about">

	<?php get_template_part( 'template-parts/global/branding' ); ?>

	<div class="footer-description">

		<p>
			<?php
			esc_html_e(
				'Senior WordPress Developer crafting exceptional digital experiences with clean code and modern design.',
				'portfolio-theme'
			);
			?>
		</p>

	</div>


	<?php if ( $linkedin || $github || $email ) : ?>

		<div class="footer-socials">

			<?php if ( $linkedin ) : ?>

				<a
					href="<?php echo esc_url( $linkedin ); ?>"
					aria-label="<?php esc_attr_e( 'LinkedIn', 'portfolio-theme' ); ?>"
					target="_blank"
					rel="noopener noreferrer"
				>
					<?php portfolio_theme_inline_svg( 'linkedin.svg' ); ?>
				</a>

			<?php endif; ?>


			<?php if ( $github ) : ?>

				<a
					href="<?php echo esc_url( $github ); ?>"
					aria-label="<?php esc_attr_e( 'GitHub', 'portfolio-theme' ); ?>"
					target="_blank"
					rel="noopener noreferrer"
				>
					<?php portfolio_theme_inline_svg( 'github.svg' ); ?>
				</a>

			<?php endif; ?>


			<?php if ( $email ) : ?>

				<a
					href="<?php echo esc_url( 'mailto:' . $email ); ?>"
					aria-label="<?php esc_attr_e( 'Send email', 'portfolio-theme' ); ?>"
				>
					<?php portfolio_theme_inline_svg( 'mail.svg' ); ?>
				</a>

			<?php endif; ?>

		</div>

	<?php endif; ?>

</div>