<?php
/**
 * Theme setup.
 *
 * @package PortfolioTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register theme supports.
 */
function portfolio_theme_setup() {
	load_theme_textdomain( 'portfolio-theme', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'align-wide' );

	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/editor-style.css' );


	add_theme_support(
		'html5',
		[
			'search-form',
			'gallery',
			'caption',
			'style',
			'script',
		]
	);

	add_theme_support( 'post-thumbnails' );

	add_theme_support(
		'custom-logo',
		[
			'height'      => 80,
			'width'       => 80,
			'flex-height' => true,
			'flex-width'  => true,
		]
	);

	add_theme_support( 'responsive-embeds' );

	register_nav_menus(
		[
			'primary'     => __( 'Primary Menu', 'portfolio-theme' ),
			'quick-links' => __( 'Quick Links', 'portfolio-theme' ),
			'services'    => __( 'Services', 'portfolio-theme' ),
		]
	);
}

add_action( 'after_setup_theme', 'portfolio_theme_setup' );
