<?php
/**
 * The template for displaying pages.
 *
 * @package PortfolioTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="main-content" class="site-main">

	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>

		<?php
			get_template_part( 'template-parts/global/page-banner' );
			
			get_template_part(
				'template-parts/contents/content',
				'page'
			);

			get_template_part( 'template-parts/global/cta' );
		?>

	<?php endwhile; ?>

</main>

<?php
get_footer();