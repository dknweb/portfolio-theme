<?php
/**
 * The front page template.
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

		<article <?php post_class( 'entry entry--front-page' ); ?>>
			<?php the_content(); ?>
		</article>

	<?php endwhile; ?>

</main>

<?php
get_footer();