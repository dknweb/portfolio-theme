<?php
/**
 * Template part for displaying a single post.
 *
 * @package PortfolioTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_template_part(
	'template-parts/global/page-banner',
	null,
	array(
		'title' => get_the_title(),
	)
);
?>

<article <?php post_class( 'entry entry--single' ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>

		<div class="entry__featured">
			<div class="container">

				<figure class="entry__figure">
					<?php
					the_post_thumbnail(
						'full',
						array(
							'class'         => 'entry__featured-image',
							'loading'       => 'eager',
							'fetchpriority' => 'high',
							'decoding'      => 'async',
						)
					);
					?>
				</figure>

			</div>
		</div>

	<?php endif; ?>

	<div class="entry__body">
		<div class="container">

			<div class="entry__layout">

				<div class="entry__content">
					<?php the_content(); ?>

					<?php
					wp_link_pages(
						array(
							'before' => '<nav class="entry__page-links" aria-label="' . esc_attr__( 'Post pages', 'portfolio-theme' ) . '">',
							'after'  => '</nav>',
						)
					);
					?>
				</div>

			</div>

		</div>
	</div>

	<footer class="entry__footer">
		<div class="container">

			<?php if ( has_category() ) : ?>
				<div class="entry__categories">
					<span class="entry__categories-label">
						<?php esc_html_e( 'Categories:', 'portfolio-theme' ); ?>
					</span>

					<?php the_category( ', ' ); ?>
				</div>
			<?php endif; ?>

		</div>
	</footer>

</article>