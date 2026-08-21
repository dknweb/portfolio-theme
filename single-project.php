<?php
/**
 * Single Project template.
 *
 * @package PortfolioTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="main-content" class="site-main">
	<div id="content" class="site-content site-content__no-padding">
		<?php
			get_template_part( 'template-parts/sections/project/hero' );	
		?>

		<?php while ( have_posts() ) : the_post(); ?>
			
				<?php the_content(); ?>
			
		<?php endwhile; ?>

		<?php get_template_part( 'template-parts/global/cta' ); ?>
	</div>
</main>

<?php
get_footer();