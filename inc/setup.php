<?php
/**
 * Theme setup - supports, menus, image sizes, content width.
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register theme supports and navigation locations.
 *
 * @return void
 */
function tfh_setup() {
	load_theme_textdomain( 'tank-free-home', TFH_DIR . 'languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'appearance-tools' );

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
			'navigation-widgets',
		)
	);

	add_theme_support(
		'custom-logo',
		array(
			'height'               => 52,
			'width'                => 200,
			'flex-height'          => true,
			'flex-width'           => true,
			'unlink-homepage-logo' => false,
		)
	);

	add_theme_support(
		'custom-background',
		array(
			'default-color' => 'ffffff',
		)
	);

	register_nav_menus(
		array(
			'primary'      => __( 'Primary Menu (header)', 'tank-free-home' ),
			'footer_links' => __( 'Footer Navigation Links', 'tank-free-home' ),
			'footer_legal' => __( 'Footer Legal Links', 'tank-free-home' ),
		)
	);

	// Editor palette mirrors the site's brand tokens.
	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name'  => __( 'Accent Red', 'tank-free-home' ),
				'slug'  => 'accent-red',
				'color' => '#F60101',
			),
			array(
				'name'  => __( 'Navy', 'tank-free-home' ),
				'slug'  => 'navy',
				'color' => '#0B2A4A',
			),
			array(
				'name'  => __( 'Ink', 'tank-free-home' ),
				'slug'  => 'ink',
				'color' => '#101E30',
			),
			array(
				'name'  => __( 'Grey', 'tank-free-home' ),
				'slug'  => 'grey',
				'color' => '#5C6B7A',
			),
			array(
				'name'  => __( 'Light Grey', 'tank-free-home' ),
				'slug'  => 'light-grey',
				'color' => '#F3F6FA',
			),
			array(
				'name'  => __( 'White', 'tank-free-home' ),
				'slug'  => 'white',
				'color' => '#FFFFFF',
			),
		)
	);

	add_theme_support( 'disable-custom-colors' );

	add_image_size( 'tfh-card', 620, 420, true );
	add_image_size( 'tfh-service', 200, 200, true );
	add_image_size( 'tfh-project', 640, 480, true );
	add_image_size( 'tfh-wide', 1440, 700, true );
	add_image_size( 'tfh-blog', 416, 260, true );
}
add_action( 'after_setup_theme', 'tfh_setup' );

/**
 * Set the content width in pixels.
 *
 * @return void
 */
function tfh_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'tfh_content_width', 1280 );
}
add_action( 'after_setup_theme', 'tfh_content_width', 0 );

/**
 * Register widget areas.
 *
 * @return void
 */
function tfh_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Blog Sidebar', 'tank-free-home' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Shown alongside blog archives and single posts.', 'tank-free-home' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'tfh_widgets_init' );

/**
 * Allow administrators to upload SVG files, used for service/feature icons.
 *
 * Restricted to `manage_options` since SVGs can carry embedded script and
 * WordPress does not sanitise them on upload; the theme only ever renders
 * them via `<img src>`, which browsers do not execute as markup.
 *
 * @param array $mimes Allowed mime types, keyed by file extension.
 * @return array
 */
function tfh_allow_svg_uploads( $mimes ) {
	if ( current_user_can( 'manage_options' ) ) {
		$mimes['svg'] = 'image/svg+xml';
	}

	return $mimes;
}
add_filter( 'upload_mimes', 'tfh_allow_svg_uploads' );

/**
 * Confirm the real file type for SVG uploads so core's sniff check doesn't
 * reject them (SVGs fail the default finfo/getimagesize-based detection).
 *
 * @param array  $data     Sniffed file data.
 * @param string $file     Full path to the file.
 * @param string $filename The name of the file.
 * @param array  $mimes    Allowed mime types.
 * @return array
 */
function tfh_fix_svg_filetype( $data, $file, $filename, $mimes ) {
	if ( ! empty( $data['ext'] ) && ! empty( $data['type'] ) ) {
		return $data;
	}

	$filetype = wp_check_filetype( $filename, $mimes );

	if ( 'svg' === $filetype['ext'] ) {
		$data['ext']             = 'svg';
		$data['type']            = 'image/svg+xml';
		$data['proper_filename'] = $filename;
	}

	return $data;
}
add_filter( 'wp_check_filetype_and_ext', 'tfh_fix_svg_filetype', 10, 4 );

/**
 * Add useful classes to the body tag.
 *
 * @param array $classes Existing body classes.
 * @return array
 */
function tfh_body_classes( $classes ) {
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( is_front_page() ) {
		$classes[] = 'tfh-front-page';
	}

	return $classes;
}
add_filter( 'body_class', 'tfh_body_classes' );

/**
 * Trim the excerpt to a friendlier length.
 *
 * @param int $length Default length.
 * @return int
 */
function tfh_excerpt_length( $length ) {
	return is_admin() ? $length : 24;
}
add_filter( 'excerpt_length', 'tfh_excerpt_length' );

/**
 * Replace the excerpt ellipsis.
 *
 * @return string
 */
function tfh_excerpt_more() {
	return is_admin() ? '[&hellip;]' : '&hellip;';
}
add_filter( 'excerpt_more', 'tfh_excerpt_more' );

/**
 * Drop the generic "Category:", "Tag:", "Archives:" etc. prefixes core adds
 * to archive titles.
 *
 * @param string $title Archive title with its default prefix.
 * @return string
 */
function tfh_archive_title( $title ) {
	return preg_replace( '/^[^:]+:\s*/', '', $title );
}
add_filter( 'get_the_archive_title', 'tfh_archive_title' );
