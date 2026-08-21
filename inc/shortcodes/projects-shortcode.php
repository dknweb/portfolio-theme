<?php
/**
 * Projects shortcode.
 *
 * @package PortfolioTheme
 */

defined( 'ABSPATH' ) || exit;

/**
 * Render the project-category filters.
 *
 * @param string $active_category Currently selected category slug.
 * @return void
 */
function portfolio_theme_render_project_filters( $active_category = '' ) {

	$terms = get_terms(
		array(
			'taxonomy'   => 'project_category',
			'hide_empty' => true,
		)
	);

	if ( is_wp_error( $terms ) || empty( $terms ) ) {
		return;
	}

	$page_url = get_permalink();

	if ( ! $page_url ) {
		return;
	}
	?>

	<nav
		class="project-filters"
		aria-label="<?php esc_attr_e( 'Filter projects by category', 'portfolio-theme' ); ?>"
	>
		<ul class="project-filters__list">

			<li class="project-filters__item">
				<a
					class="project-filters__link<?php echo empty( $active_category ) ? ' project-filters__link--active' : ''; ?>"
					href="<?php echo esc_url( $page_url ); ?>"
					<?php echo empty( $active_category ) ? 'aria-current="page"' : ''; ?>
				>
					<?php esc_html_e( 'All Projects', 'portfolio-theme' ); ?>
				</a>
			</li>

			<?php foreach ( $terms as $term ) : ?>
				<?php
				$is_active = $active_category === $term->slug;

				$filter_url = add_query_arg(
					'project_category',
					$term->slug,
					$page_url
				);
				?>

				<li class="project-filters__item">
					<a
						class="project-filters__link<?php echo $is_active ? ' project-filters__link--active' : ''; ?>"
						href="<?php echo esc_url( $filter_url ); ?>"
						<?php echo $is_active ? 'aria-current="page"' : ''; ?>
					>
						<?php echo esc_html( $term->name ); ?>
					</a>
				</li>
			<?php endforeach; ?>

		</ul>
	</nav>

	<?php
}

/**
 * Render the projects shortcode.
 *
 * Usage:
 * [portfolio_projects]
 *
 * Available attributes:
 * [portfolio_projects posts_per_page="9" columns="3" filters="true" pagination="true"]
 *
 * @param array<string, mixed> $atts Shortcode attributes.
 * @return string
 */
function portfolio_theme_projects_shortcode( $atts ) {

	$atts = shortcode_atts(
		array(
			'posts_per_page' => 9,
			'columns'        => 3,
			'category'       => '',
			'filters'        => 'true',
			'pagination'     => 'true',
			'order'          => 'DESC',
			'orderby'        => 'date',
            'view_more'      => 'false'
		),
		$atts,
		'portfolio_projects'
	);

	$posts_per_page = absint( $atts['posts_per_page'] );
	$columns        = absint( $atts['columns'] );
	$show_filters   = filter_var( $atts['filters'], FILTER_VALIDATE_BOOLEAN );
	$show_pagination = filter_var( $atts['pagination'], FILTER_VALIDATE_BOOLEAN );
    $show_view_more = filter_var( $atts['view_more'], FILTER_VALIDATE_BOOLEAN );

	if ( $posts_per_page < 1 ) {
		$posts_per_page = 9;
	}

	/*
	 * Restrict the column count so arbitrary classes cannot be generated.
	 */
	if ( ! in_array( $columns, array( 1, 2, 3, 4 ), true ) ) {
		$columns = 3;
	}

	$allowed_orderby = array(
		'date',
		'title',
		'menu_order',
		'modified',
		'rand',
	);

	$orderby = sanitize_key( $atts['orderby'] );

	if ( ! in_array( $orderby, $allowed_orderby, true ) ) {
		$orderby = 'date';
	}

	$order = strtoupper( sanitize_text_field( $atts['order'] ) );

	if ( ! in_array( $order, array( 'ASC', 'DESC' ), true ) ) {
		$order = 'DESC';
	}

	/*
	 * Use a shortcode-specific pagination query parameter instead of
	 * WordPress's global paged variable.
	 */
	$current_page = isset( $_GET['projects_page'] )
		? absint( wp_unslash( $_GET['projects_page'] ) )
		: 1;

	if ( $current_page < 1 ) {
		$current_page = 1;
	}

	/*
	 * The shortcode attribute provides a default category.
	 * The URL filter overrides it when present.
	 */
	$active_category = sanitize_title( $atts['category'] );

	if ( isset( $_GET['project_category'] ) ) {
		$active_category = sanitize_title(
			wp_unslash( $_GET['project_category'] )
		);
	}

	$query_args = array(
		'post_type'           => 'project',
		'post_status'         => 'publish',
		'posts_per_page'      => $posts_per_page,
		'paged'               => $current_page,
		'order'               => $order,
		'orderby'             => $orderby,
		'ignore_sticky_posts' => true,
		'no_found_rows'       => ! $show_pagination,
	);

	if ( ! empty( $active_category ) ) {
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'project_category',
				'field'    => 'slug',
				'terms'    => $active_category,
			),
		);
	}

	$projects = new WP_Query( $query_args );

	ob_start();
	?>

	<div
		class="projects-shortcode"
		aria-label="<?php esc_attr_e( 'Portfolio projects', 'portfolio-theme' ); ?>"
	>

		<?php
		if ( $show_filters ) {
			portfolio_theme_render_project_filters( $active_category );
		}
		?>

		<?php if ( $projects->have_posts() ) : ?>

			<div class="projects-grid grid grid--<?php echo esc_attr( $columns ); ?>">

				<?php
				while ( $projects->have_posts() ) {
					$projects->the_post();

					get_template_part(
						'template-parts/sections/projects-archive/card',
						null,
						array(
							'show_category' => true,
						)
					);
				}
				?>

			</div>

            <?php if ( $show_view_more ) { ?>
            <div class="project-view-more">
                
                <a 
                    class="btn btn--primary animate-fade-up"
                    href="<?php echo esc_url( home_url( '/projects/' ) ); ?>">
                        <?php esc_html_e( 'View More Projects', 'portfolio-theme' ); ?>
                </a>

            </div>
            <?php } ?>

			<?php
			if ( $show_pagination && $projects->max_num_pages > 1 ) {
				portfolio_theme_render_projects_pagination(
					$projects->max_num_pages,
					$current_page,
					$active_category
				);
			}
			?>

		<?php else : ?>

			<div class="projects-shortcode__empty">
				<p>
					<?php esc_html_e( 'Projects will be added soon.', 'portfolio-theme' ); ?>
				</p>
			</div>

		<?php endif; ?>

    </div>

	<?php
	wp_reset_postdata();

	return (string) ob_get_clean();
}
add_shortcode( 'portfolio_projects', 'portfolio_theme_projects_shortcode' );

/**
 * Render shortcode pagination.
 *
 * @param int    $total_pages    Total number of pages.
 * @param int    $current_page   Current page.
 * @param string $active_category Active category slug.
 * @return void
 */
function portfolio_theme_render_projects_pagination(
	$total_pages,
	$current_page,
	$active_category = ''
) {

	$page_url = get_permalink();

	if ( ! $page_url ) {
		return;
	}

	$base_url = add_query_arg(
		'projects_page',
		'%#%',
		$page_url
	);

	if ( ! empty( $active_category ) ) {
		$base_url = add_query_arg(
			'project_category',
			$active_category,
			$base_url
		);
	}

	$pagination_links = paginate_links(
		array(
			'base'      => $base_url,
			'format'    => '',
			'current'   => $current_page,
			'total'     => $total_pages,
			'type'      => 'array',
			'prev_text' => sprintf(
				'<span aria-hidden="true">&larr;</span><span class="screen-reader-text">%s</span>',
				esc_html__( 'Previous projects page', 'portfolio-theme' )
			),
			'next_text' => sprintf(
				'<span class="screen-reader-text">%s</span><span aria-hidden="true">&rarr;</span>',
				esc_html__( 'Next projects page', 'portfolio-theme' )
			),
		)
	);

	if ( empty( $pagination_links ) ) {
		return;
	}
	?>

	<nav
		class="projects-pagination"
		aria-label="<?php esc_attr_e( 'Projects pagination', 'portfolio-theme' ); ?>"
	>
		<ul class="projects-pagination__list">

			<?php foreach ( $pagination_links as $pagination_link ) : ?>

				<li class="projects-pagination__item">
					<?php
					echo wp_kses(
						$pagination_link,
						array(
							'a' => array(
								'class' => true,
								'href'  => true,
							),
							'span' => array(
								'class'        => true,
								'aria-current' => true,
								'aria-hidden'  => true,
							),
						)
					);
					?>
				</li>

			<?php endforeach; ?>

		</ul>
	</nav>

	<?php
}