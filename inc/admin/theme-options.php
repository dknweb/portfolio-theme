<?php
/**
 * Theme Options.
 *
 * @package PortfolioTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme options key.
 */
const PORTFOLIO_THEME_OPTIONS = 'portfolio_theme_options';


/**
 * Add the Portfolio Settings page.
 */
function portfolio_theme_add_options_page(): void {

	add_theme_page(
		__( 'Portfolio Settings', 'portfolio-theme' ),
		__( 'Portfolio Settings', 'portfolio-theme' ),
		'manage_options',
		'portfolio-theme-settings',
		'portfolio_theme_render_options_page'
	);
}

add_action( 'admin_menu', 'portfolio_theme_add_options_page' );


/**
 * Register theme settings.
 */
function portfolio_theme_register_settings(): void {

	register_setting(
		'portfolio_theme_settings',
		PORTFOLIO_THEME_OPTIONS,
		array(
			'type'              => 'array',
			'sanitize_callback' => 'portfolio_theme_sanitize_options',
			'default'           => array(),
		)
	);

	/*
	 * Contact information.
	 */
	add_settings_section(
		'portfolio_theme_contact',
		__( 'Contact Information', 'portfolio-theme' ),
		'portfolio_theme_render_contact_section',
		'portfolio-theme-settings'
	);

	add_settings_field(
		'email',
		__( 'Email Address', 'portfolio-theme' ),
		'portfolio_theme_render_text_field',
		'portfolio-theme-settings',
		'portfolio_theme_contact',
		array(
			'id'   => 'email',
			'type' => 'email',
		)
	);

	add_settings_field(
		'phone',
		__( 'Phone Number', 'portfolio-theme' ),
		'portfolio_theme_render_text_field',
		'portfolio-theme-settings',
		'portfolio_theme_contact',
		array(
			'id'   => 'phone',
			'type' => 'tel',
		)
	);

	add_settings_field(
		'location',
		__( 'Location', 'portfolio-theme' ),
		'portfolio_theme_render_text_field',
		'portfolio-theme-settings',
		'portfolio_theme_contact',
		array(
			'id'   => 'location',
			'type' => 'text',
		)
	);

	/*
	 * Social profiles.
	 */
	add_settings_section(
		'portfolio_theme_social',
		__( 'Social Profiles', 'portfolio-theme' ),
		'portfolio_theme_render_social_section',
		'portfolio-theme-settings'
	);

	add_settings_field(
		'linkedin',
		__( 'LinkedIn URL', 'portfolio-theme' ),
		'portfolio_theme_render_url_field',
		'portfolio-theme-settings',
		'portfolio_theme_social',
		array(
			'id' => 'linkedin',
		)
	);

	add_settings_field(
		'github',
		__( 'GitHub URL', 'portfolio-theme' ),
		'portfolio_theme_render_url_field',
		'portfolio-theme-settings',
		'portfolio_theme_social',
		array(
			'id' => 'github',
		)
	);

	/*
	 * Resume.
	 */
	add_settings_section(
		'portfolio_theme_resume',
		__( 'Resume', 'portfolio-theme' ),
		'portfolio_theme_render_resume_section',
		'portfolio-theme-settings'
	);

	add_settings_field(
		'resume_id',
		__( 'Resume PDF', 'portfolio-theme' ),
		'portfolio_theme_render_resume_field',
		'portfolio-theme-settings',
		'portfolio_theme_resume'
	);
}

add_action( 'admin_init', 'portfolio_theme_register_settings' );


/**
 * Sanitize theme options.
 *
 * @param array $input Submitted options.
 * @return array
 */
function portfolio_theme_sanitize_options( $input ): array {

	$output = array();

	if ( ! is_array( $input ) ) {
		return $output;
	}

	$output['email'] = isset( $input['email'] )
		? sanitize_email( $input['email'] )
		: '';

	$output['phone'] = isset( $input['phone'] )
		? sanitize_text_field( $input['phone'] )
		: '';

	$output['location'] = isset( $input['location'] )
		? sanitize_text_field( $input['location'] )
		: '';

	$output['linkedin'] = isset( $input['linkedin'] )
		? esc_url_raw( $input['linkedin'] )
		: '';

	$output['github'] = isset( $input['github'] )
		? esc_url_raw( $input['github'] )
		: '';

	$resume_id = isset( $input['resume_id'] )
		? absint( $input['resume_id'] )
		: 0;

	if (
		$resume_id &&
		'attachment' === get_post_type( $resume_id ) &&
		'application/pdf' === get_post_mime_type( $resume_id )
	) {
		$output['resume_id'] = $resume_id;
	} else {
		$output['resume_id'] = 0;
	}

	return $output;
}


/**
 * Return all Portfolio Theme options.
 */
function portfolio_theme_get_options(): array {

	$options = get_option( PORTFOLIO_THEME_OPTIONS, array() );

	return is_array( $options ) ? $options : array();
}


/**
 * Return a single Portfolio Theme option.
 *
 * @param string $key     Option key.
 * @param mixed  $default Default value.
 * @return mixed
 */
function portfolio_theme_get_option( string $key, $default = '' ) {

	$options = portfolio_theme_get_options();

	return $options[ $key ] ?? $default;
}


/**
 * Contact section description.
 */
function portfolio_theme_render_contact_section(): void {
	?>
	<p>
		<?php esc_html_e( 'Contact information displayed throughout the portfolio website.', 'portfolio-theme' ); ?>
	</p>
	<?php
}


/**
 * Social section description.
 */
function portfolio_theme_render_social_section(): void {
	?>
	<p>
		<?php esc_html_e( 'Add links to your public social and developer profiles.', 'portfolio-theme' ); ?>
	</p>
	<?php
}


/**
 * Resume section description.
 */
function portfolio_theme_render_resume_section(): void {
	?>
	<p>
		<?php esc_html_e( 'Select the PDF used by all Download CV buttons throughout the site.', 'portfolio-theme' ); ?>
	</p>
	<?php
}


/**
 * Render text-based settings field.
 *
 * @param array $args Field arguments.
 */
function portfolio_theme_render_text_field( array $args ): void {

	$id    = $args['id'];
	$type  = $args['type'] ?? 'text';
	$value = portfolio_theme_get_option( $id );
	?>

	<input
		type="<?php echo esc_attr( $type ); ?>"
		id="portfolio-theme-<?php echo esc_attr( $id ); ?>"
		name="<?php echo esc_attr( PORTFOLIO_THEME_OPTIONS ); ?>[<?php echo esc_attr( $id ); ?>]"
		value="<?php echo esc_attr( $value ); ?>"
		class="regular-text"
	>

	<?php
}


/**
 * Render URL settings field.
 *
 * @param array $args Field arguments.
 */
function portfolio_theme_render_url_field( array $args ): void {

	$id    = $args['id'];
	$value = portfolio_theme_get_option( $id );
	?>

	<input
		type="url"
		id="portfolio-theme-<?php echo esc_attr( $id ); ?>"
		name="<?php echo esc_attr( PORTFOLIO_THEME_OPTIONS ); ?>[<?php echo esc_attr( $id ); ?>]"
		value="<?php echo esc_url( $value ); ?>"
		class="regular-text"
		placeholder="https://"
	>

	<?php
}


/**
 * Render Resume PDF field.
 */
function portfolio_theme_render_resume_field(): void {

	$resume_id  = absint( portfolio_theme_get_option( 'resume_id', 0 ) );
	$resume_url = $resume_id ? wp_get_attachment_url( $resume_id ) : '';
	?>

	<div class="portfolio-theme-media-field">

		<input
			type="hidden"
			id="portfolio-theme-resume-id"
			name="<?php echo esc_attr( PORTFOLIO_THEME_OPTIONS ); ?>[resume_id]"
			value="<?php echo esc_attr( $resume_id ); ?>"
		>

		<input
			type="text"
			id="portfolio-theme-resume-url"
			value="<?php echo esc_url( $resume_url ); ?>"
			class="regular-text"
			readonly
			placeholder="<?php esc_attr_e( 'No PDF selected', 'portfolio-theme' ); ?>"
		>

		<button
			type="button"
			class="button"
			id="portfolio-theme-select-resume"
		>
			<?php esc_html_e( 'Select PDF', 'portfolio-theme' ); ?>
		</button>

		<button
			type="button"
			class="button"
			id="portfolio-theme-remove-resume"
			<?php echo $resume_id ? '' : 'hidden'; ?>
		>
			<?php esc_html_e( 'Remove', 'portfolio-theme' ); ?>
		</button>

	</div>

	<p class="description">
		<?php esc_html_e( 'Upload or select a PDF from the WordPress Media Library.', 'portfolio-theme' ); ?>
	</p>

	<?php
}


/**
 * Render Portfolio Settings page.
 */
function portfolio_theme_render_options_page(): void {

	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	?>

	<div class="wrap">

		<h1>
			<?php esc_html_e( 'Portfolio Settings', 'portfolio-theme' ); ?>
		</h1>

		<form action="options.php" method="post">

			<?php
			settings_fields( 'portfolio_theme_settings' );
			do_settings_sections( 'portfolio-theme-settings' );
			submit_button();
			?>

		</form>

	</div>

	<?php
}


/**
 * Load assets for the Portfolio Settings page.
 *
 * @param string $hook_suffix Current admin page.
 */
function portfolio_theme_options_assets( string $hook_suffix ): void {

	if ( 'appearance_page_portfolio-theme-settings' !== $hook_suffix ) {
		return;
	}

	wp_enqueue_media();

	$script_path = '/assets/js/admin/theme-options.js';
	$script_file = get_theme_file_path( $script_path );

	wp_enqueue_script(
		'portfolio-theme-options',
		get_theme_file_uri( $script_path ),
		array(),
		file_exists( $script_file ) ? filemtime( $script_file ) : null,
		true
	);
}

add_action( 'admin_enqueue_scripts', 'portfolio_theme_options_assets' );