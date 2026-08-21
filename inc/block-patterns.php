<?php
/**
 * Block pattern registration.
 *
 * @package PortfolioTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the theme block pattern category.
 *
 * @return void
 */
function portfolio_theme_register_pattern_categories() {
	register_block_pattern_category(
		'portfolio-theme',
		array(
			'label'       => __( 'Portfolio Theme', 'portfolio-theme' ),
			'description' => __( 'Patterns provided by Portfolio Theme.', 'portfolio-theme' ),
		)
	);
	
	register_block_pattern_category(
		'portfolio-theme-sections',
		array(
			'label' => __( 'Portfolio Sections', 'portfolio-theme' ),
		)
	);

	register_block_pattern_category(
		'portfolio-pages',
		array(
			'label'       => __( 'Portfolio Pages', 'portfolio-theme' ),
			'description' => __( 'Complete page layouts for the portfolio theme.', 'portfolio-theme' ),
		)
	);

	register_block_pattern_category(
		'portfolio-project-sections',
		array(
			'label'       => __( 'Portfolio Project Sections', 'portfolio-theme' ),
			'description' => __( 'Project sections for the portfolio theme.', 'portfolio-theme' ),
		)
	);
}
add_action( 'init', 'portfolio_theme_register_pattern_categories' );