<?php
/**
 * Template Name: Services
 *
 * @package PortfolioTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="main-content" class="site-main">

	<?php get_template_part( 'template-parts/global/page-banner' ); ?>

	<?php get_template_part( 'template-parts/sections/services/intro' ); ?>

	<?php get_template_part( 'template-parts/sections/services/list' ); ?>

	<?php get_template_part( 'template-parts/sections/services/process' ); ?>

	<?php get_template_part( 'template-parts/global/cta' ); ?>

</main>

<?php
get_footer();