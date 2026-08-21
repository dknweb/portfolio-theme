<?php
/**
 * Project custom meta fields.
 *
 * @package PortfolioTheme
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register Project metadata.
 */
function portfolio_theme_register_project_meta(): void {
	$meta_fields = array(
		'project_platform' => array(
			'type'              => 'string',
			'sanitize_callback' => 'sanitize_text_field',
		),
		'project_duration' => array(
			'type'              => 'string',
			'sanitize_callback' => 'sanitize_text_field',
		),
		'project_demo_url' => array(
			'type'              => 'string',
			'sanitize_callback' => 'esc_url_raw',
		),
		'project_github_url' => array(
			'type'              => 'string',
			'sanitize_callback' => 'esc_url_raw',
		),
	);

	foreach ( $meta_fields as $meta_key => $args ) {
		register_post_meta(
			'project',
			$meta_key,
			array(
				'type'              => $args['type'],
				'single'            => true,
				'show_in_rest'      => true,
				'sanitize_callback' => $args['sanitize_callback'],
				'auth_callback'     => static function (): bool {
					return current_user_can( 'edit_posts' );
				},
			)
		);
	}
}
add_action( 'init', 'portfolio_theme_register_project_meta' );

/**
 * Register the Project Details meta box.
 */
function portfolio_theme_add_project_meta_box(): void {
	add_meta_box(
		'portfolio-theme-project-details',
		__( 'Project Details', 'portfolio-theme' ),
		'portfolio_theme_render_project_meta_box',
		'project',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes_project', 'portfolio_theme_add_project_meta_box' );

/**
 * Render the Project Details meta box.
 *
 * @param WP_Post $post Current post object.
 */
function portfolio_theme_render_project_meta_box( WP_Post $post ): void {
	$project_platform   = get_post_meta( $post->ID, 'project_platform', true );
	$project_duration   = get_post_meta( $post->ID, 'project_duration', true );
	$project_demo_url   = get_post_meta( $post->ID, 'project_demo_url', true );
	$project_github_url = get_post_meta( $post->ID, 'project_github_url', true );

	wp_nonce_field(
		'portfolio_theme_save_project_meta',
		'portfolio_theme_project_meta_nonce'
	);
	?>

	<table class="form-table" role="presentation">
		<tbody>
			<tr>
				<th scope="row">
					<label for="project-platform">
						<?php esc_html_e( 'Platform', 'portfolio-theme' ); ?>
					</label>
				</th>

				<td>
					<input
						id="project-platform"
						class="regular-text"
						type="text"
						name="project_platform"
						value="<?php echo esc_attr( $project_platform ); ?>"
						placeholder="<?php esc_attr_e( 'WordPress', 'portfolio-theme' ); ?>"
					>
				</td>
			</tr>

			<tr>
				<th scope="row">
					<label for="project-duration">
						<?php esc_html_e( 'Project Duration', 'portfolio-theme' ); ?>
					</label>
				</th>

				<td>
					<input
						id="project-duration"
						class="regular-text"
						type="text"
						name="project_duration"
						value="<?php echo esc_attr( $project_duration ); ?>"
						placeholder="<?php esc_attr_e( '4 Weeks', 'portfolio-theme' ); ?>"
					>
				</td>
			</tr>

			<tr>
				<th scope="row">
					<label for="project-demo-url">
						<?php esc_html_e( 'Live Demo URL', 'portfolio-theme' ); ?>
					</label>
				</th>

				<td>
					<input
						id="project-demo-url"
						class="regular-text"
						type="url"
						name="project_demo_url"
						value="<?php echo esc_url( $project_demo_url ); ?>"
						placeholder="https://example.com"
					>
				</td>
			</tr>

			<tr>
				<th scope="row">
					<label for="project-github-url">
						<?php esc_html_e( 'GitHub URL', 'portfolio-theme' ); ?>
					</label>
				</th>

				<td>
					<input
						id="project-github-url"
						class="regular-text"
						type="url"
						name="project_github_url"
						value="<?php echo esc_url( $project_github_url ); ?>"
						placeholder="https://github.com/username/repository"
					>
				</td>
			</tr>
		</tbody>
	</table>

	<?php
}

/**
 * Save Project metadata.
 *
 * @param int $post_id Current post ID.
 */
function portfolio_theme_save_project_meta( int $post_id ): void {
	$nonce = isset( $_POST['portfolio_theme_project_meta_nonce'] )
		? sanitize_text_field(
			wp_unslash( $_POST['portfolio_theme_project_meta_nonce'] )
		)
		: '';

	if (
		! $nonce ||
		! wp_verify_nonce( $nonce, 'portfolio_theme_save_project_meta' )
	) {
		return;
	}

	if (
		defined( 'DOING_AUTOSAVE' ) &&
		DOING_AUTOSAVE
	) {
		return;
	}

	if ( wp_is_post_revision( $post_id ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$text_fields = array(
		'project_platform',
		'project_duration',
	);

	$url_fields = array(
		'project_demo_url',
		'project_github_url',
	);

	foreach ( $text_fields as $meta_key ) {
		$value = isset( $_POST[ $meta_key ] )
			? sanitize_text_field( wp_unslash( $_POST[ $meta_key ] ) )
			: '';

		portfolio_theme_update_project_meta(
			$post_id,
			$meta_key,
			$value
		);
	}

	foreach ( $url_fields as $meta_key ) {
		$value = isset( $_POST[ $meta_key ] )
			? esc_url_raw( wp_unslash( $_POST[ $meta_key ] ) )
			: '';

		portfolio_theme_update_project_meta(
			$post_id,
			$meta_key,
			$value
		);
	}
}
add_action( 'save_post_project', 'portfolio_theme_save_project_meta' );

/**
 * Update or delete a Project meta value.
 *
 * Empty fields are removed instead of storing empty strings.
 *
 * @param int    $post_id  Project ID.
 * @param string $meta_key Meta key.
 * @param string $value    Sanitized value.
 */
function portfolio_theme_update_project_meta(
	int $post_id,
	string $meta_key,
	string $value
): void {
	if ( '' === $value ) {
		delete_post_meta( $post_id, $meta_key );
		return;
	}

	update_post_meta( $post_id, $meta_key, $value );
}