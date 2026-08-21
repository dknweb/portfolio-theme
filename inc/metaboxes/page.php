<?php
/**
 * Page editor enhancements.
 *
 * @package PortfolioTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enable excerpts for pages.
 */
function portfolio_enable_page_excerpt() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'portfolio_enable_page_excerpt' );


/**
 * Register page badge metabox.
 */
function portfolio_add_page_badge_metabox() {
	add_meta_box(
		'portfolio-page-badge',
		__( 'Page Badge', 'portfolio-theme' ),
		'portfolio_page_badge_metabox_callback',
		'page',
		'side',
		'default'
	);
}
add_action( 'add_meta_boxes', 'portfolio_add_page_badge_metabox' );


/**
 * Render page badge metabox.
 *
 * @param WP_Post $post Current post object.
 */
function portfolio_page_badge_metabox_callback( $post ) {
	$badge = get_post_meta( $post->ID, '_portfolio_page_badge', true );

	wp_nonce_field(
		'portfolio_save_page_badge',
		'portfolio_page_badge_nonce'
	);
	?>

	<p>
		<label for="portfolio-page-badge">
			<?php esc_html_e( 'Badge text', 'portfolio-theme' ); ?>
		</label>
	</p>

	<input
		type="text"
		id="portfolio-page-badge"
		name="portfolio_page_badge"
		value="<?php echo esc_attr( $badge ); ?>"
		class="widefat"
		placeholder="<?php esc_attr_e( 'e.g. Services', 'portfolio-theme' ); ?>"
	>

	<?php
}


/**
 * Save page badge.
 *
 * @param int $post_id Current post ID.
 */
function portfolio_save_page_badge( $post_id ) {

	if (
		! isset( $_POST['portfolio_page_badge_nonce'] ) ||
		! wp_verify_nonce(
			sanitize_text_field(
				wp_unslash( $_POST['portfolio_page_badge_nonce'] )
			),
			'portfolio_save_page_badge'
		)
	) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_page', $post_id ) ) {
		return;
	}

	if ( ! isset( $_POST['portfolio_page_badge'] ) ) {
		delete_post_meta( $post_id, '_portfolio_page_badge' );
		return;
	}

	$badge = sanitize_text_field(
		wp_unslash( $_POST['portfolio_page_badge'] )
	);

	if ( $badge ) {
		update_post_meta(
			$post_id,
			'_portfolio_page_badge',
			$badge
		);
	} else {
		delete_post_meta(
			$post_id,
			'_portfolio_page_badge'
		);
	}
}
add_action( 'save_post_page', 'portfolio_save_page_badge' );