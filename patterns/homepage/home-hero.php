<?php
/**
 * Title: Portfolio Homepage Hero
 * Slug: portfolio-theme/home-hero
 * Description: A two-column portfolio hero section with introduction, buttons, and an image.
 * Categories: portfolio-theme
 * Keywords: hero, homepage, portfolio, developer
 * Viewport Width: 1240
 * Inserter: true
 */
?>

<!-- wp:kadence/rowlayout {"uniqueID":"744_15e60a-87","colLayout":"equal","firstColumnWidth":55,"secondColumnWidth":45,"thirdColumnWidth":0,"fourthColumnWidth":0,"fifthColumnWidth":0,"sixthColumnWidth":0,"kbVersion":2,"className":"section-hero","metadata":{"name":"Portfolio Homepage Hero","categories":["portfolio-theme"],"patternName":"portfolio-theme/home-hero"}} -->
<!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"744_f6afc1-b8","kbVersion":2} -->
<div class="wp-block-kadence-column kadence-column744_f6afc1-b8">
	<div class="kt-inside-inner-col">
		<!-- wp:paragraph {"className":"badge"} -->
		<p class="badge animate-fade-up">Hello, I'm</p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":1,"className":"section-hero__title animate-fade-up animate-delay-100"} -->
		<h1
			class="wp-block-heading section-hero__title animate-fade-up animate-delay-100"
		>
			Dan Biscaro
		</h1>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"className":"section-hero__subtitle animate-fade-up animate-delay-200"} -->
		<p class="section-hero__subtitle animate-fade-up animate-delay-200">
			Senior
			<mark
				style="background-color: rgba(0, 0, 0, 0)"
				class="has-inline-color has-luminous-vivid-orange-color"
				>WordPress</mark
			>
			Developer
		</p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph {"className":"section-hero__description animate-fade-up animate-delay-300"} -->
		<p class="section-hero__description animate-fade-up animate-delay-300">
			I build fast, accessible, and scalable WordPress websites using modern
			front-end technologies. With over 12 years of experience developing custom
			WordPress solutions, I create websites focused on performance,
			maintainability, and exceptional user experience.
		</p>
		<!-- /wp:paragraph -->

		<!-- wp:kadence/advancedbtn {"hAlign":"left","uniqueID":"744_5fe1ed-91","className":"section-hero__actions animate-fade-up animate-delay-400"} -->
		<div
			class="wp-block-kadence-advancedbtn kb-buttons-wrap kb-btns744_5fe1ed-91 section-hero__actions animate-fade-up animate-delay-400"
		>
			<!-- wp:kadence/singlebtn {"uniqueID":"744_12cddf-2b","text":"Hire Me","link":"#","inheritStyles":"inherit","className":"block-button block-button\u002d\u002dsecondary"} /-->

			<!-- wp:kadence/singlebtn {"uniqueID":"744_b541a8-61","text":"Download CV","link":"#","icon":"fe_download","inheritStyles":"inherit","className":"block-button block-button\u002d\u002doutline"} /-->
		</div>
		<!-- /wp:kadence/advancedbtn -->
	</div>
</div>
<!-- /wp:kadence/column -->

<!-- wp:kadence/column {"id":2,"borderWidth":["","","",""],"uniqueID":"744_0d77a8-9d","kbVersion":2} -->
<div class="wp-block-kadence-column kadence-column744_0d77a8-9d">
	<div class="kt-inside-inner-col">
		<!-- wp:kadence/image {"id":751,"sizeSlug":"full","linkDestination":"none","uniqueID":"744_b077eb-81","className":"section-hero__portrait animate-lift"} -->
		<figure
			class="wp-block-kadence-image kb-image744_b077eb-81 size-full section-hero__portrait animate-lift animate-fade-in animate-delay-300"
		>
			<img
				src="<?php echo esc_url( get_theme_file_uri( '/assets/images/dan-biscaro.webp' ) ); ?>"
				alt="Dan Biscaro, Senior WordPress Developer"
				class="kb-img wp-image-751"
			/>
		</figure>
		<!-- /wp:kadence/image -->
	</div>
</div>
<!-- /wp:kadence/column -->
<!-- /wp:kadence/rowlayout -->