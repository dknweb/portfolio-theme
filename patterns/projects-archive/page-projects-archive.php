<?php
/**
 * Title: Projects Page
 * Slug: portfolio-pages/page-projects-archive
 * Categories: portfolio-pages
 * Keywords: projects, portfolio, case studies
 * Description: A complete projects page containing the global banner, project listing shortcode, and global call-to-action section.
 * Viewport Width: 1440
 * Inserter: true
 */
?>

<!-- wp:pattern {"slug":"portfolio-theme/global-page-banner"} /-->

<!-- wp:group {"tagName":"section","className":"projects-archive","layout":{"type":"constrained"}} -->
<section class="wp-block-group projects-archive">
	<!-- wp:group {"className":"projects-archive__inner","layout":{"type":"constrained","contentSize":"1200px"}} -->
	<div class="wp-block-group projects-archive__inner">

		<!-- wp:shortcode -->
		[portfolio_projects]
		<!-- /wp:shortcode -->

	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->

<!-- wp:pattern {"slug":"portfolio-theme/global-cta"} /-->