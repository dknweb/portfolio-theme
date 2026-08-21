<?php
/**
 * Template Name: Full Column No Title
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

		<article <?php post_class( 'entry entry--full-width' ); ?>>

			<div class="entry__content">
				<?php the_content(); ?>
			</div>

		</article>

	<?php endwhile; ?>

</main>

<?php
get_footer();