<?php
/**
 * Single post template.
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
		<?php
		the_post();

		get_template_part(
			'template-parts/contents/content',
			'single'
		);
		?>
	<?php endwhile; ?>

</main>

<?php
get_footer();