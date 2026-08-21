<?php
/**
 * Footer Bottom
 *
 * @package PortfolioTheme
 */
?>

<div class="site-footer-bottom">
	<div class="container">
		<div class="site-footer-bottom__inner">
			<div class="footer-copyright">
				<p>
					&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?>
					<?php esc_html_e( 'Dan Biscaro. All rights reserved.', 'portfolio-theme' ); ?>
				</p>
			</div>
			<div class="footer-back-to-top">
				<a href="#main-content">
					<?php esc_html_e( 'Back to top', 'portfolio-theme' ); ?>
				</a>
			</div>
		</div>
	</div>
</div>
