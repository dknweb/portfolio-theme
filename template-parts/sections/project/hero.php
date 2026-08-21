<?php
/**
 * Single project hero section.
 *
 * @package PortfolioTheme
 */

$project_id = get_the_ID();

$project_platform   = get_post_meta( $project_id, 'project_platform', true );
$project_duration   = get_post_meta( $project_id, 'project_duration', true );
$project_demo_url   = get_post_meta( $project_id, 'project_demo_url', true );
$project_github_url = get_post_meta( $project_id, 'project_github_url', true );

$project_platform = $project_platform ?: __( 'WordPress', 'portfolio-theme' );

$thumbnail_id  = get_post_thumbnail_id( $project_id );
$thumbnail_alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );

if ( ! $thumbnail_alt ) {
	$thumbnail_alt = sprintf(
		/* Translators: %s is the project title. */
		__( '%s Project Preview', 'portfolio-theme' ),
		get_the_title()
	);
}
?>

<section class="project-hero" aria-labelledby="project-title">
	<div class="container">

		<div class="project-hero__inner">

			<div class="project-hero__content">
				<span class="project-hero__badge badge">
					<?php esc_html_e( 'Featured Project', 'portfolio-theme' ); ?>
				</span>

				<h1 id="project-title" class="project-hero__title">
					<?php the_title(); ?>
				</h1>

				<?php if ( has_excerpt() ) : ?>
					<p class="project-hero__summary">
						<?php echo esc_html( get_the_excerpt() ); ?>
					</p>
				<?php endif; ?>

				<ul
					class="project-hero__meta"
					aria-label="<?php esc_attr_e( 'Project information', 'portfolio-theme' ); ?>"
				>
					<li class="project-hero__meta-entry">
                        <span class="project-hero__meta-icon icon icon--fill icon--clear" aria-hidden="true">
                            <?php portfolio_theme_inline_svg( 'wordpress.svg' ); ?>
                        </span>

						<span><?php echo esc_html( $project_platform ); ?></span>
					</li>

					<li class="project-hero__meta-entry">
						<span class="project-hero__meta-icon icon icon--clear" aria-hidden="true">
                            <?php portfolio_theme_inline_svg( 'calendar.svg' ); ?>
                        </span>

						<time datetime="<?php echo esc_attr( get_the_date( 'Y-m' ) ); ?>">
							<?php echo esc_html( get_the_date( 'F Y' ) ); ?>
						</time>
					</li>

					<?php if ( $project_duration ) : ?>
						<li class="project-hero__meta-entry">
							<span class="project-hero__meta-icon icon icon--clear" aria-hidden="true">
								<?php portfolio_theme_inline_svg( 'time.svg' ); ?>
							</span>
						
							

							<span><?php echo esc_html( $project_duration ); ?></span>
						</li>
					<?php endif; ?>
				</ul>

				<?php if ( $project_demo_url || $project_github_url ) : ?>
					<div class="project-hero__actions">

						<?php if ( $project_demo_url ) : ?>
							<a
								class="project-hero__button btn btn--secondary"
								href="<?php echo esc_url( $project_demo_url ); ?>"
								target="_blank"
								rel="noopener noreferrer"
							>
								<span>
									<?php esc_html_e( 'Visit Live Demo', 'portfolio-theme' ); ?>
								</span>

								<span
									class="project-hero__button-icon icon icon--clear "
									aria-hidden="true"
								>
									<?php portfolio_theme_inline_svg( 'external-link.svg' ); ?>
								</span>

								<span class="screen-reader-text">
									<?php esc_html_e( 'Opens in a new tab', 'portfolio-theme' ); ?>
								</span>
							</a>
						<?php endif; ?>

						<?php if ( $project_github_url ) : ?>
							<a
								class="project-hero__button btn btn--outline"
								href="<?php echo esc_url( $project_github_url ); ?>"
								target="_blank"
								rel="noopener noreferrer"
							>
								<span>
									<?php esc_html_e( 'View on GitHub', 'portfolio-theme' ); ?>
								</span>

								<span
									class="project-hero__button-icon icon icon--clear"
									aria-hidden="true"
								>
									<?php portfolio_theme_inline_svg( 'github.svg' ); ?>
								</span>

								<span class="screen-reader-text">
									<?php esc_html_e( 'Opens in a new tab', 'portfolio-theme' ); ?>
								</span>
							</a>
						<?php endif; ?>

					</div>
				<?php endif; ?>
			</div>

			<?php if ( has_post_thumbnail() ) : ?>
				<figure class="project-hero__media">
					<?php
					the_post_thumbnail(
						'full',
						array(
							'class'         => 'project-hero__image',
							'alt'           => $thumbnail_alt,
							'loading'       => 'eager',
							'decoding'      => 'async',
							'fetchpriority' => 'high',
						)
					);
					?>
				</figure>
			<?php endif; ?>

		</div>
	</div>
</section>