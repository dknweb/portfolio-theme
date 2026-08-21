<?php
/**
 * Theme functions.
 *
 * @package PortfolioTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Core theme files.
 */
require_once get_theme_file_path( '/inc/theme-setup.php' );
require_once get_theme_file_path( '/inc/vite.php' );
require_once get_theme_file_path( '/inc/enqueue.php' );
require_once get_theme_file_path( '/inc/helpers.php' );


/**
 * Post types.
 */
require_once get_theme_file_path( '/inc/post-types/project-post-type.php' );


/**
 * Metaboxes.
 */
require_once get_theme_file_path( '/inc/metaboxes/project-metabox.php' );
require_once get_theme_file_path( '/inc/metaboxes/page.php' );


/**
 * Shortcodes.
 */
require_once get_theme_file_path( '/inc/shortcodes/projects-shortcode.php' );


/**
 * Block patterns.
 */
require_once get_theme_file_path( '/inc/block-patterns.php' );


/**
 * Admin.
 */
require_once get_theme_file_path( '/inc/admin/theme-options.php' );