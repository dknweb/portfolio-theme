<?php
$cv_url = portfolio_theme_get_cv_url();
?>

<div class="header-actions">
	<button
		class="menu-toggle"
		type="button"
		aria-label="<?php esc_attr_e( 'Open navigation', 'portfolio-theme' ); ?>"
		aria-expanded="false"
		aria-controls="site-navigation">

		<span aria-hidden="true"></span>
		<span aria-hidden="true"></span>
		<span aria-hidden="true"></span>

	</button>

	<?php if ( $cv_url ) : ?>
		<a class="btn btn--primary" href="<?php echo esc_url( $cv_url ); ?>" download>
			<span class="label">
				<?php esc_html_e( 'Download CV', 'portfolio-theme' ); ?>
			</span>
			<span class="icon icon--clear icon--small">
				<?php portfolio_theme_inline_svg( 'download.svg' ); ?>
			</span>
		</a>
	<?php endif; ?>

</div>
