<?php
/**
 * Template part for displaying page content.
 *
 * @package PortfolioTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<article <?php post_class( 'entry entry--page' ); ?>>

	<div class="container">

		<div class="entry__content">
			<?php the_content(); ?>
		</div>

	</div>

</article>