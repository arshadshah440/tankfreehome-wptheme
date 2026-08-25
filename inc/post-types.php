<?php
/**
 * Custom post types used by the homepage sections.
 *
 * - tfh_service     -> the "Reliable Tankless Water Heater Services" grid
 * - tfh_project     -> the "Latest Tankless Projects" gallery
 * - tfh_testimonial -> the "What They Say About Us" grid
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the Service, Project and Testimonial post types.
 *
 * @return void
 */
function tfh_register_post_types() {

	register_post_type(
		'tfh_service',
		array(
			'labels'        => array(
				'name'                  => __( 'Services', 'tank-free-home' ),
				'singular_name'         => __( 'Service', 'tank-free-home' ),
				'add_new'               => __( 'Add Service', 'tank-free-home' ),
				'add_new_item'          => __( 'Add New Service', 'tank-free-home' ),
				'edit_item'             => __( 'Edit Service', 'tank-free-home' ),
				'new_item'              => __( 'New Service', 'tank-free-home' ),
				'view_item'             => __( 'View Service', 'tank-free-home' ),
				'search_items'          => __( 'Search Services', 'tank-free-home' ),
				'not_found'             => __( 'No services yet.', 'tank-free-home' ),
				'not_found_in_trash'    => __( 'No services in the trash.', 'tank-free-home' ),
				'all_items'             => __( 'All Services', 'tank-free-home' ),
				'menu_name'             => __( 'Services', 'tank-free-home' ),
				'featured_image'        => __( 'Service image', 'tank-free-home' ),
				'set_featured_image'    => __( 'Set service image', 'tank-free-home' ),
				'remove_featured_image' => __( 'Remove service image', 'tank-free-home' ),
			),
			'public'        => true,
			'has_archive'   => true,
			'show_in_rest'  => true,
			'menu_icon'     => 'dashicons-admin-tools',
			'menu_position' => 25,
			'supports'      => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes', 'revisions' ),
			'rewrite'       => array( 'slug' => 'services' ),
		)
	);

	register_taxonomy(
		'tfh_service_cat',
		'tfh_service',
		array(
			'labels'            => array(
				'name'          => __( 'Service Categories', 'tank-free-home' ),
				'singular_name' => __( 'Service Category', 'tank-free-home' ),
				'menu_name'     => __( 'Categories', 'tank-free-home' ),
			),
			'hierarchical'      => true,
			'public'            => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array( 'slug' => 'service-category' ),
		)
	);

	register_post_type(
		'tfh_project',
		array(
			'labels'        => array(
				'name'                  => __( 'Projects', 'tank-free-home' ),
				'singular_name'         => __( 'Project', 'tank-free-home' ),
				'add_new'               => __( 'Add Project', 'tank-free-home' ),
				'add_new_item'          => __( 'Add New Project', 'tank-free-home' ),
				'edit_item'             => __( 'Edit Project', 'tank-free-home' ),
				'new_item'              => __( 'New Project', 'tank-free-home' ),
				'view_item'             => __( 'View Project', 'tank-free-home' ),
				'search_items'          => __( 'Search Projects', 'tank-free-home' ),
				'not_found'             => __( 'No projects yet.', 'tank-free-home' ),
				'not_found_in_trash'    => __( 'No projects in the trash.', 'tank-free-home' ),
				'all_items'             => __( 'All Projects', 'tank-free-home' ),
				'menu_name'             => __( 'Projects', 'tank-free-home' ),
				'featured_image'        => __( 'Project photo', 'tank-free-home' ),
				'set_featured_image'    => __( 'Set project photo', 'tank-free-home' ),
				'remove_featured_image' => __( 'Remove project photo', 'tank-free-home' ),
			),
			'public'        => true,
			'has_archive'   => true,
			'show_in_rest'  => true,
			'menu_icon'     => 'dashicons-format-image',
			'menu_position' => 26,
			'supports'      => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes', 'revisions' ),
			'rewrite'       => array( 'slug' => 'projects' ),
		)
	);

	register_post_type(
		'tfh_testimonial',
		array(
			'labels'        => array(
				'name'                  => __( 'Testimonials', 'tank-free-home' ),
				'singular_name'         => __( 'Testimonial', 'tank-free-home' ),
				'add_new'               => __( 'Add Testimonial', 'tank-free-home' ),
				'add_new_item'          => __( 'Add New Testimonial', 'tank-free-home' ),
				'edit_item'             => __( 'Edit Testimonial', 'tank-free-home' ),
				'new_item'              => __( 'New Testimonial', 'tank-free-home' ),
				'search_items'          => __( 'Search Testimonials', 'tank-free-home' ),
				'not_found'             => __( 'No testimonials yet.', 'tank-free-home' ),
				'not_found_in_trash'    => __( 'No testimonials in the trash.', 'tank-free-home' ),
				'all_items'             => __( 'All Testimonials', 'tank-free-home' ),
				'menu_name'             => __( 'Testimonials', 'tank-free-home' ),
				'featured_image'        => __( 'Photo', 'tank-free-home' ),
				'set_featured_image'    => __( 'Set photo', 'tank-free-home' ),
				'remove_featured_image' => __( 'Remove photo', 'tank-free-home' ),
			),
			'public'        => false,
			'show_ui'       => true,
			'show_in_menu'  => true,
			'show_in_rest'  => true,
			'menu_icon'     => 'dashicons-format-quote',
			'menu_position' => 27,
			'supports'      => array( 'title', 'thumbnail', 'page-attributes', 'revisions' ),
			'has_archive'   => false,
			'rewrite'       => false,
		)
	);
}
add_action( 'init', 'tfh_register_post_types' );

/**
 * Flush rewrite rules once after the theme is activated so the /services and
 * /projects permalinks work without a manual visit to Settings -> Permalinks.
 *
 * @return void
 */
function tfh_flush_rewrites() {
	tfh_register_post_types();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'tfh_flush_rewrites' );

/**
 * Use the "Person" column heading for testimonials instead of "Title".
 *
 * @param array $columns Admin list table columns.
 * @return array
 */
function tfh_testimonial_columns( $columns ) {
	$columns['title'] = __( 'Person', 'tank-free-home' );

	return $columns;
}
add_filter( 'manage_tfh_testimonial_posts_columns', 'tfh_testimonial_columns' );
