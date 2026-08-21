<?php
/**
 * Project card template.
 *
 * @package PortfolioTheme
 */

defined( 'ABSPATH' ) || exit;

$args = wp_parse_args(
	$args ?? array(),
	array(
		'show_category' => true,
	)
);

$project_id = get_the_ID();
$terms      = get_the_terms( $project_id, 'project_category' );
$excerpt    = get_the_excerpt();

if ( empty( $excerpt ) ) {
	$excerpt = wp_trim_words(
		wp_strip_all_tags( get_the_content() ),
		24
	);
}
?>

<article
	id="project-<?php echo esc_attr( $project_id ); ?>"
	<?php post_class( 'project-card animate-lift animate-fade-up animate-delay-200' ); ?>
>

	<a
		class="project-card__link"
		href="<?php the_permalink(); ?>"
		aria-label="<?php echo esc_attr( sprintf( __( 'View case study: %s', 'portfolio-theme' ), get_the_title() ) ); ?>"
	>

		<figure class="project-card__media">

			<?php if ( has_post_thumbnail() ) : ?>

				<?php
				the_post_thumbnail(
					'large',
					array(
						'class'    => 'project-card__image',
						'loading'  => 'lazy',
						'decoding' => 'async',
					)
				);
				?>

			<?php else : ?>

				<div
					class="project-card__placeholder"
					aria-hidden="true"
				>
					<svg
						class="project-card__placeholder-icon"
						viewBox="0 0 64 48"
						fill="none"
						xmlns="http://www.w3.org/2000/svg"
					>
						<circle
							cx="38"
							cy="12"
							r="6"
							fill="currentColor"
						/>
						<path
							d="M4 44L20 24L30 35L38 27L60 44H4Z"
							fill="currentColor"
						/>
					</svg>
				</div>

			<?php endif; ?>

			<span class="badge badge--surface project-card__badge">
				<?php esc_html_e( 'Case Study', 'portfolio-theme' ); ?>
			</span>

		</figure>

		<div class="project-card__content">

			<div class="project-card__details">

				<h3 class="project-card__title">
					<?php the_title(); ?>
				</h3>

				<?php if ( $args['show_category'] && ! empty( $terms ) && ! is_wp_error( $terms ) ) : ?>

					<p class="project-card__category">
						<?php echo esc_html( $terms[0]->name ); ?>
					</p>

				<?php endif; ?>

				<?php if ( ! empty( $excerpt ) ) : ?>

					<p class="project-card__excerpt">
						<?php echo esc_html( $excerpt ); ?>
					</p>

				<?php endif; ?>

			</div>

			<span
				class="project-card__action icon"
				aria-hidden="true"
			>
				<?php portfolio_theme_inline_svg( 'arrow-right.svg' ); ?>

			</span>

		</div>

	</a>

</article>