<?php
/**
 * Global call-to-action section.
 *
 * @package PortfolioTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$contact_url = get_permalink( get_page_by_path( 'contact' ) );
?>

<section class="global-cta" aria-labelledby="global-cta-title">
	<div class="container">

		<div class="global-cta__inner">

			<div class="global-cta__content">

				<h2 id="global-cta-title" class="global-cta__title animate-fade-up">
					<?php esc_html_e( 'Have a project in mind?', 'portfolio-theme' ); ?>
				</h2>

				<p class="global-cta__description animate-fade-up  animate-delay-200">
					<?php
					esc_html_e(
						"I'm always open to discussing new opportunities and helping bring your ideas to life.",
						'portfolio-theme'
					);
					?>
				</p>

			</div>

			<div class="global-cta__action">

				<a
					class="btn btn--primary global-cta__button animate-fade-up  animate-delay-400"
					href="<?php echo esc_url( $contact_url ); ?>"
				>
					<?php esc_html_e( "Let's Work Together", 'portfolio-theme' ); ?>
				</a>

			</div>

		</div>

	</div>
</section>