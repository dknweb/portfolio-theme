<?php
/**
 * Vite integration.
 *
 * @package PortfolioTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Vite development server URL.
 */
if ( ! defined( 'PORTFOLIO_THEME_VITE_SERVER' ) ) {
	define(
		'PORTFOLIO_THEME_VITE_SERVER',
		'http://127.0.0.1:5173'
	);
}

/**
 * Determine whether Vite development mode is enabled.
 *
 * Development mode is controlled explicitly through wp-config.php
 * rather than probing the Vite server on every request.
 *
 * @return bool
 */
function portfolio_theme_vite_dev_mode(): bool {
	return defined( 'PORTFOLIO_THEME_VITE_DEV' )
		&& true === PORTFOLIO_THEME_VITE_DEV;
}

/**
 * Check whether the Vite dev server is actually reachable.
 *
 * Uses a short-timeout socket connect rather than wp_remote_get(),
 * and caches the result briefly so this never runs on every request.
 * This is a safety net around portfolio_theme_vite_dev_mode() — it
 * does not replace it, since a project may intentionally want to
 * force dev mode without a live check (e.g. CI, tests).
 *
 * @return bool
 */
function portfolio_theme_vite_server_reachable(): bool {
	static $reachable = null;

	if ( null !== $reachable ) {
		return $reachable;
	}

	$cache_key = 'portfolio_theme_vite_reachable';
	$cached    = get_transient( $cache_key );

	if ( false !== $cached ) {
		return $reachable = ( '1' === $cached );
	}

	$parts = wp_parse_url( PORTFOLIO_THEME_VITE_SERVER );
	$host  = $parts['host'] ?? '127.0.0.1';
	$port  = $parts['port'] ?? 5173;

	$socket = @fsockopen( $host, (int) $port, $errno, $errstr, 0.25 );

	$reachable = false !== $socket;

	if ( $socket ) {
		fclose( $socket );
	}

	// Short TTL: long enough to avoid a socket connect on every
	// request, short enough to notice within a few seconds when you
	// start/stop `npm run dev`.
	set_transient( $cache_key, $reachable ? '1' : '0', 5 );

	return $reachable;
}

/**
 * Show an admin-only notice when dev mode is on but the Vite
 * server isn't reachable, so the mismatch is visible instead of
 * silently falling back.
 *
 * @return void
 */
function portfolio_theme_vite_dev_mode_notice(): void {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	if ( ! portfolio_theme_vite_dev_mode() ) {
		return;
	}

	if ( portfolio_theme_vite_server_reachable() ) {
		return;
	}

	printf(
		'<div class="notice notice-warning"><p>%s</p></div>',
		esc_html(
			sprintf(
				'Ridge Rush Cycles: PORTFOLIO_THEME_VITE_DEV is enabled but no Vite server was found at %s. Falling back to the production build. Run `npm run dev` or disable the constant.',
				PORTFOLIO_THEME_VITE_SERVER
			)
		)
	);
}
add_action( 'admin_notices', 'portfolio_theme_vite_dev_mode_notice' );

/**
 * Enqueue a Vite entry.
 *
 * @param string $entry Vite source entry relative to the theme root.
 *
 * @return void
 */
function portfolio_theme_vite( string $entry ): void {
	$handle = 'portfolio-theme-' . sanitize_title(
		pathinfo( $entry, PATHINFO_FILENAME )
	);

	/*
	 * Development.
	 */
	if (
		portfolio_theme_vite_dev_mode() &&
		portfolio_theme_vite_server_reachable()
	) {

		if ( ! wp_script_is( 'portfolio-theme-vite-client', 'enqueued' ) ) {
			wp_enqueue_script(
				'portfolio-theme-vite-client',
				PORTFOLIO_THEME_VITE_SERVER . '/@vite/client',
				[],
				null,
				false
			);
		}

		wp_enqueue_script(
			$handle,
			PORTFOLIO_THEME_VITE_SERVER . '/' . ltrim( $entry, '/' ),
			[ 'portfolio-theme-vite-client' ],
			null,
			true
		);

		return;
	}

	/*
	 * Production.
	 */
	$manifest_path = get_theme_file_path(
		'/dist/.vite/manifest.json'
	);

	if ( ! file_exists( $manifest_path ) ) {
		return;
	}

	$manifest_contents = file_get_contents( $manifest_path );

	if ( false === $manifest_contents ) {
		return;
	}

	$manifest = json_decode( $manifest_contents, true );

	if (
		! is_array( $manifest ) ||
		empty( $manifest[ $entry ]['file'] )
	) {
		return;
	}

	$asset = $manifest[ $entry ];

	/*
	 * Production CSS.
	 */
	if (
		! empty( $asset['css'] ) &&
		is_array( $asset['css'] )
	) {
		foreach ( $asset['css'] as $index => $css ) {

			$css_path = get_theme_file_path(
				'/dist/' . $css
			);

			wp_enqueue_style(
				$handle . '-style-' . $index,
				get_theme_file_uri(
					'/dist/' . $css
				),
				[],
				file_exists( $css_path )
					? (string) filemtime( $css_path )
					: null
			);
		}
	}

	/*
	 * Production JavaScript.
	 */
	$script_path = get_theme_file_path(
		'/dist/' . $asset['file']
	);

	wp_enqueue_script(
		$handle,
		get_theme_file_uri(
			'/dist/' . $asset['file']
		),
		[],
		file_exists( $script_path )
			? (string) filemtime( $script_path )
			: null,
		true
	);
}

/**
 * Mark Vite JavaScript files as ES modules.
 *
 * @param string $tag    Script HTML.
 * @param string $handle Script handle.
 * @param string $src    Script source URL.
 *
 * @return string
 */
function portfolio_theme_script_loader_tag(
	string $tag,
	string $handle,
	string $src
): string {

	if (
		'portfolio-theme-vite-client' === $handle ||
		str_starts_with( $handle, 'portfolio-theme-' )
	) {
		return sprintf(
			'<script type="module" src="%s"></script>',
			esc_url( $src )
		);
	}

	return $tag;
}

add_filter(
	'script_loader_tag',
	'portfolio_theme_script_loader_tag',
	10,
	3
);