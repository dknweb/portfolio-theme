<?php
/**
 * Main template file.
 *
 * @package PortfolioTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$posts_page_id = (int) get_option( 'page_for_posts' );
$blog_title = $posts_page_id
	? get_the_title( $posts_page_id )
	: __( 'Blog', 'portfolio-theme' );
?>

<main id="main-content" class="site-main">


	<?php
	get_template_part(
		'template-parts/global/page-banner',
		null,
		array(
			'title' => $blog_title,
		)
	);
	?>

	<section class="blog-listing" aria-labelledby="blog-title">
	
			<div class="container">

			<?php if ( have_posts() ) : ?>

				<div class="blog-listing__grid">
					<?php while ( have_posts() ) : ?>
						<?php
						the_post();

						get_template_part(
							'template-parts/contents/content',
							get_post_format()
						);
						?>
					<?php endwhile; ?>
				</div>

				<nav
					class="blog-listing__pagination"
					aria-label="<?php esc_attr_e( 'Blog pagination', 'portfolio-theme' ); ?>"
				>
					<?php
					the_posts_pagination(
						array(
							'mid_size'  => 2,
							'prev_text' => esc_html__( 'Previous', 'portfolio-theme' ),
							'next_text' => esc_html__( 'Next', 'portfolio-theme' ),
						)
					);
					?>
				</nav>

			<?php else : ?>

				<div class="blog-listing__empty">
					<h2 class="blog-listing__empty-title">
						<?php esc_html_e( 'No posts found', 'portfolio-theme' ); ?>
					</h2>

					<p class="blog-listing__empty-text">
						<?php esc_html_e( 'There are no posts to display yet.', 'portfolio-theme' ); ?>
					</p>
				</div>

			<?php endif; ?>

		</div>
	</section>
	
</main>

<?php
get_footer();