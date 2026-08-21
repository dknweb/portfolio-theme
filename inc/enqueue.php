<?php
/**
 * Theme asset loading.
 *
 * @package PortfolioTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function portfolio_enqueue_assets() {

	portfolio_theme_vite( 'assets/js/main.js' );
	
}

add_action( 'wp_enqueue_scripts', 'portfolio_enqueue_assets', 200 );