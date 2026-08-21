<?php
/**
 * Register the Project custom post type and taxonomy.
 *
 * @package PortfolioTheme
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the Project post type.
 *
 * The post type does not use an archive because projects are displayed
 * through the [portfolio_projects] shortcode on a standard WordPress page.
 *
 * @return void
 */
function portfolio_theme_register_project_post_type() {

	$labels = array(
		'name'                  => __( 'Projects', 'portfolio-theme' ),
		'singular_name'         => __( 'Project', 'portfolio-theme' ),
		'menu_name'             => __( 'Projects', 'portfolio-theme' ),
		'name_admin_bar'        => __( 'Project', 'portfolio-theme' ),
		'add_new'               => __( 'Add New', 'portfolio-theme' ),
		'add_new_item'          => __( 'Add New Project', 'portfolio-theme' ),
		'new_item'              => __( 'New Project', 'portfolio-theme' ),
		'edit_item'             => __( 'Edit Project', 'portfolio-theme' ),
		'view_item'             => __( 'View Project', 'portfolio-theme' ),
		'all_items'             => __( 'All Projects', 'portfolio-theme' ),
		'search_items'          => __( 'Search Projects', 'portfolio-theme' ),
		'parent_item_colon'     => __( 'Parent Projects:', 'portfolio-theme' ),
		'not_found'             => __( 'No projects found.', 'portfolio-theme' ),
		'not_found_in_trash'    => __( 'No projects found in Trash.', 'portfolio-theme' ),
		'featured_image'        => __( 'Project Image', 'portfolio-theme' ),
		'set_featured_image'    => __( 'Set project image', 'portfolio-theme' ),
		'remove_featured_image' => __( 'Remove project image', 'portfolio-theme' ),
		'use_featured_image'    => __( 'Use as project image', 'portfolio-theme' ),
		'archives'              => __( 'Project Archives', 'portfolio-theme' ),
		'insert_into_item'      => __( 'Insert into project', 'portfolio-theme' ),
		'uploaded_to_this_item' => __( 'Uploaded to this project', 'portfolio-theme' ),
		'filter_items_list'     => __( 'Filter projects list', 'portfolio-theme' ),
		'items_list_navigation' => __( 'Projects list navigation', 'portfolio-theme' ),
		'items_list'            => __( 'Projects list', 'portfolio-theme' ),
	);

	$args = array(
		'labels'              => $labels,
		'description'         => __( 'Portfolio projects and case studies.', 'portfolio-theme' ),
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_rest'        => true,
		'query_var'           => true,

		/*
		 * The archive is disabled because the projects page is built
		 * with a shortcode.
		 */
		'has_archive'         => false,

		/*
		 * Use /project/project-name/ for single projects.
		 * This avoids conflicting with the standard /projects/ page.
		 */
		'rewrite'        => array(
			'slug'       => 'project',
			'with_front' => false,
		),

		'capability_type'     => 'post',
		'hierarchical'        => false,
		'menu_position'       => 20,
		'menu_icon'           => 'dashicons-portfolio',
		'supports'            => array(
			'title',
			'editor',
			'excerpt',
			'thumbnail',
			'revisions',
		),
		'taxonomies'          => array( 'project_category' ),
		'exclude_from_search' => false,
		'can_export'          => true,
		'delete_with_user'    => false,
	);

	register_post_type( 'project', $args );
}
add_action( 'init', 'portfolio_theme_register_project_post_type' );

/**
 * Register the Project Category taxonomy.
 *
 * @return void
 */
function portfolio_theme_register_project_taxonomy() {

	$labels = array(
		'name'              => __( 'Project Categories', 'portfolio-theme' ),
		'singular_name'     => __( 'Project Category', 'portfolio-theme' ),
		'search_items'      => __( 'Search Project Categories', 'portfolio-theme' ),
		'all_items'         => __( 'All Project Categories', 'portfolio-theme' ),
		'parent_item'       => __( 'Parent Project Category', 'portfolio-theme' ),
		'parent_item_colon' => __( 'Parent Project Category:', 'portfolio-theme' ),
		'edit_item'         => __( 'Edit Project Category', 'portfolio-theme' ),
		'update_item'       => __( 'Update Project Category', 'portfolio-theme' ),
		'add_new_item'      => __( 'Add New Project Category', 'portfolio-theme' ),
		'new_item_name'     => __( 'New Project Category Name', 'portfolio-theme' ),
		'menu_name'         => __( 'Categories', 'portfolio-theme' ),
	);

	$args = array(
		'labels'            => $labels,
		'public'            => true,
		'publicly_queryable' => true,
		'hierarchical'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_rest'      => true,
		'show_tagcloud'     => false,

		/*
		 * Taxonomy archives are disabled because filtering is handled
		 * on the standard Projects page.
		 */
		'rewrite'           => false,
	);

	register_taxonomy(
		'project_category',
		array( 'project' ),
		$args
	);
}
add_action( 'init', 'portfolio_theme_register_project_taxonomy' );