<?php
/**
 * Vite integration.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Vite development server.
 */
define(
    'PORTFOLIO_THEME_VITE_SERVER',
    'http://127.0.0.1:5173'
);

/**
 * Check whether Vite development mode is enabled.
 */
function portfolio_theme_vite_running(): bool {

	return in_array(
		wp_get_environment_type(),
		[ 'local', 'development' ],
		true
	);
	
}

/**
 * Enqueue a Vite entry.
 *
 * Example:
 *
 * portfolio_theme_vite( 'assets/js/main.js' );
 * portfolio_theme_vite( 'assets/js/editor.js' );
 */
function portfolio_theme_vite( string $entry ): void {

	$handle = 'theme-' . sanitize_title( pathinfo( $entry, PATHINFO_FILENAME ) );

	/*
	|--------------------------------------------------------------------------
	| Development (HMR)
	|--------------------------------------------------------------------------
	*/

	if ( portfolio_theme_vite_running() ) {

		if ( ! wp_script_is( 'vite-client', 'enqueued' ) ) {

			wp_enqueue_script(
				'vite-client',
				PORTFOLIO_THEME_VITE_SERVER . '/@vite/client',
				[],
				null,
				false
			);

		}

		wp_enqueue_script(
			$handle,
			PORTFOLIO_THEME_VITE_SERVER . '/' . ltrim( $entry, '/' ),
			[ 'vite-client' ],
			null,
			true
		);

		return;
	}

	/*
	|--------------------------------------------------------------------------
	| Production
	|--------------------------------------------------------------------------
	*/

	$manifest_path = get_theme_file_path( '/dist/.vite/manifest.json' );

	if ( ! file_exists( $manifest_path ) ) {
		return;
	}

	$manifest_contents = file_get_contents( $manifest_path );

	if ( false === $manifest_contents ) {
		return;
	}

	$manifest = json_decode( $manifest_contents, true );

	if ( ! is_array( $manifest ) || empty( $manifest[ $entry ]['file'] ) ) {
		return;
	}

	$asset = $manifest[ $entry ];

	/*
	|--------------------------------------------------------------------------
	| CSS
	|--------------------------------------------------------------------------
	*/

	if ( ! empty( $asset['css'] ) ) {

		foreach ( $asset['css'] as $index => $css ) {

			wp_enqueue_style(
				$handle . "-style-{$index}",
				get_theme_file_uri( '/dist/' . $css ),
				[],
				(string) filemtime( get_theme_file_path( '/dist/' . $css ) )
			);

		}

	}

	/*
	|--------------------------------------------------------------------------
	| JavaScript
	|--------------------------------------------------------------------------
	*/

	wp_enqueue_script(
		$handle,
		get_theme_file_uri( '/dist/' . $asset['file'] ),
		[],
		(string) filemtime( get_theme_file_path( '/dist/' . $asset['file'] ) ),
		true
	);
}

/**
 * Output JavaScript as ES modules.
 */
function portfolio_theme_script_loader_tag(
	string $tag,
	string $handle,
	string $src
): string {

	if (
		'vite-client' === $handle ||
		str_starts_with( $handle, 'theme-' )
	) {
		return sprintf(
			'<script type="module" src="%s"></script>',
			esc_url( $src )
		);
	}

	return $tag;
}

add_filter( 'script_loader_tag', 'portfolio_theme_script_loader_tag', 10, 3 );


