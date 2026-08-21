<?php
/**
 * Title: Portfolio Homepage Projects
 * Slug: portfolio-theme/home-projects
 * Description: A portfolio projects section featuring selected work in a responsive card layout.
 * Categories: portfolio-theme
 * Keywords: projects, homepage, portfolio, developer
 * Viewport Width: 1240
 * Inserter: true
 */
?>
<!-- wp:kadence/rowlayout {"uniqueID":"888_ca0029-6b","columns":1,"colLayout":"equal","firstColumnWidth":0,"secondColumnWidth":0,"thirdColumnWidth":0,"fourthColumnWidth":0,"fifthColumnWidth":0,"sixthColumnWidth":0,"kbVersion":2,"className":"section-projects"} -->
<!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"888_b46b67-e5","kbVersion":2} -->
<div class="wp-block-kadence-column kadence-column888_b46b67-e5">
	<div class="kt-inside-inner-col">
		<!-- wp:kadence/rowlayout {"uniqueID":"888_67e021-24","columns":1,"colLayout":"equal","firstColumnWidth":0,"secondColumnWidth":0,"thirdColumnWidth":0,"fourthColumnWidth":0,"fifthColumnWidth":0,"sixthColumnWidth":0,"kbVersion":2} -->
		<!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"888_b810a6-1a","textAlign":["center","",""],"kbVersion":2} -->
		<div class="wp-block-kadence-column kadence-column888_b810a6-1a">
			<div class="kt-inside-inner-col">
				<!-- wp:paragraph {"className":"badge"} -->
				<p class="badge animate-fade-up">Projects</p>
				<!-- /wp:paragraph -->

				<!-- wp:heading {"className":"section-heading__title"} -->
				<h2 class="wp-block-heading section-heading__title animate-fade-up animate-delay-100">Featured Work</h2>
				<!-- /wp:heading -->
			</div>
		</div>
		<!-- /wp:kadence/column -->
		<!-- /wp:kadence/rowlayout -->

		<!-- wp:kadence/rowlayout {"uniqueID":"888_237fc2-90","columns":1,"colLayout":"equal","firstColumnWidth":0,"secondColumnWidth":0,"thirdColumnWidth":0,"fourthColumnWidth":0,"fifthColumnWidth":0,"sixthColumnWidth":0,"kbVersion":2} -->
		<!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"888_1c52be-b6","kbVersion":2} -->
		<div class="wp-block-kadence-column kadence-column888_1c52be-b6">
			<div class="kt-inside-inner-col">
				<!-- wp:shortcode -->
				[portfolio_projects posts_per_page="3" columns="3" filters="false" pagination="false" view_more="true"]
				<!-- /wp:shortcode -->
			</div>
		</div>
		<!-- /wp:kadence/column -->
		<!-- /wp:kadence/rowlayout -->
	</div>
</div>
<!-- /wp:kadence/column -->
<!-- /wp:kadence/rowlayout -->
