<?php

/**
 * Theme Helper Functions
 *
 * @package PortfolioTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function portfolio_cleanup_head() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_action( 'wp_head', 'rsd_link' );
    remove_action( 'wp_head', 'wlwmanifest_link' );
    remove_action( 'wp_head', 'wp_generator' );
}
add_action( 'init', 'portfolio_cleanup_head' );


if ( ! function_exists( 'portfolio_theme_inline_svg' ) ) {

	/**
	 * Output an inline SVG from the theme assets.
	 *
	 * @param string $filename SVG filename (e.g. 'wordpress.svg').
	 * @param string $class Optional CSS class added to the root SVG element.
	 * @return void
	 */
	function portfolio_theme_inline_svg( string $filename, string $class = '' ): void {

		$filename = basename( $filename );

		$path = get_theme_file_path( 'assets/images/icons/' . $filename );

		if ( ! file_exists( $path ) ) {
			return;
		}

		$svg = file_get_contents( $path );

		if ( false === $svg ) {
			return;
		}

		if ( ! empty( $class ) ) {
			$svg = preg_replace(
				'/<svg\b/',
				'<svg class="' . esc_attr( $class ) . '"',
				$svg,
				1
			);
		}

		echo $svg; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}


// 1. Allow the SVG file type to pass through the uploader
function allow_svg_uploads_for_admin( $mimes ) {
    if ( current_user_can( 'manage_options' ) ) {
        $mimes['svg'] = 'image/svg+xml';
        $mimes['svgz'] = 'image/svg+xml';
    }
    return $mimes;
}
add_filter( 'upload_mimes', 'allow_svg_uploads_for_admin' );

// 2. Fix the Media Library layout so SVG thumbnails actually render
function fix_svg_media_library_preview() {
    echo '<style type="text/css">
        .attachment-266x266, .thumbnail img[src$=".svg"] { 
            width: 100% !important; 
            height: auto !important; 
        }
    </style>';
}
add_action( 'admin_head', 'fix_svg_media_library_preview' );


/**
 * Get portfolio email address.
 */
function portfolio_theme_get_email(): string {
	return sanitize_email(
		(string) portfolio_theme_get_option( 'email', '' )
	);
}


/**
 * Get portfolio phone number.
 */
function portfolio_theme_get_phone(): string {
	return sanitize_text_field(
		(string) portfolio_theme_get_option( 'phone', '' )
	);
}


/**
 * Get a phone number formatted for a tel: link.
 */
function portfolio_theme_get_phone_href(): string {

	$phone = portfolio_theme_get_phone();

	if ( ! $phone ) {
		return '';
	}

	return preg_replace( '/[^0-9+]/', '', $phone );
}


/**
 * Get portfolio location.
 */
function portfolio_theme_get_location(): string {
	return sanitize_text_field(
		(string) portfolio_theme_get_option( 'location', '' )
	);
}


/**
 * Get social profile URL.
 *
 * @param string $network Social network key.
 */
function portfolio_theme_get_social_url( string $network ): string {

	$allowed = array(
		'linkedin',
		'github',
	);

	if ( ! in_array( $network, $allowed, true ) ) {
		return '';
	}

	return esc_url_raw(
		(string) portfolio_theme_get_option( $network, '' )
	);
}


/**
 * Get resume attachment ID.
 */
function portfolio_theme_get_resume_id(): int {
	return absint(
		portfolio_theme_get_option( 'resume_id', 0 )
	);
}


/**
 * Get resume PDF URL.
 */
function portfolio_theme_get_cv_url(): string {

	$resume_id = portfolio_theme_get_resume_id();

	if ( ! $resume_id ) {
		return '';
	}

	if ( 'application/pdf' !== get_post_mime_type( $resume_id ) ) {
		return '';
	}

	$url = wp_get_attachment_url( $resume_id );

	return $url ? $url : '';
}