<?php
/**
 * Default template part for displaying a post in a listing.
 *
 * @package PortfolioTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<article <?php post_class( 'entry-card' ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<a
			class="entry-card__image"
			href="<?php the_permalink(); ?>"
			aria-label="<?php echo esc_attr( sprintf( __( 'Read %s', 'portfolio-theme' ), get_the_title() ) ); ?>"
		>
			<?php
			the_post_thumbnail(
				'large',
				array(
					'loading'  => 'lazy',
					'decoding' => 'async',
				)
			);
			?>
		</a>
	<?php endif; ?>

	<div class="entry-card__content">

		<div class="entry-card__meta">
			<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
				<?php echo esc_html( get_the_date() ); ?>
			</time>
		</div>

		<h2 class="entry-card__title">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>

		<div class="entry-card__excerpt">
			<?php the_excerpt(); ?>
		</div>

		<a class="entry-card__link" href="<?php the_permalink(); ?>">
			<?php esc_html_e( 'Read more', 'portfolio-theme' ); ?>
		</a>

	</div>

</article>